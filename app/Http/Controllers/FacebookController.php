<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use App\FacebookPage;

class FacebookController extends Controller
{
    public function fanpageList()
    {
        $fbData = FacebookPage::get();
        return view('facebook.fanpage-list', compact('fbData'));
    }

    public function getAccessToken($accessToken, $userID)
    {
        $pages = self::getListAdminPage($accessToken);

        foreach ($pages as $pageObj) {
            $page = (object)$pageObj;
            $this->addFacebookPage($page, $userID);
        }
        return redirect()->back();
    }

    public function removeFacebookPage($id)
    {
        $page = FacebookPage::findOrFail($id);
        $page->delete();
        toastr()->success('Delete fanpage successfully!');
        return redirect()->back();
    }

    private function addFacebookPage($pageObj, $userID)
    {
        $page = FacebookPage::where('page_id', $pageObj->id)->first();
        if (!$page) {
            $page = new FacebookPage;
        }
        $page->name = $pageObj->name;
        $page->avatar = "";
        $page->page_id = $pageObj->id;
        $page->access_token = $pageObj->access_token;
        $page->user_id = auth()->id();
        $page->save();
        self::updateFanpageAva($page);
        toastr()->success('Add fanpage successfully!');
        return redirect()->back();
    }

    public static function updateFanpageAva($page)
    {
        $access_token = $page->access_token;
        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $page->page_id . '/picture?redirect=0&access_token=' . $access_token;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Facebook get user information request',
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $resp = curl_exec($curl);
        $resp = json_decode($resp);
        try {
            $page->avatar = $resp->data->url;
            $page->save();
            return $resp->data->url;
        } catch (\Exception $e) {
            Log::info("Update ava error");
            Log::info(json_encode($resp));
        }
    }

    public static function getListAdminPage($accessToken)
    {
        $fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.app_version'),
        ]);
        try {
            $response = $fb->get('/me/accounts', $accessToken);
        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $pages = $response->getGraphEdge()->asArray();
        return $pages;
    }
}
