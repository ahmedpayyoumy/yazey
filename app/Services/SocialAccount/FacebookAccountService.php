<?php
namespace App\Services\SocialAccount;

use App\Services\CRUDService;
use App\FacebookPage;
use App\DataSource;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FacebookAccountService extends CRUDService
{
    public function __construct(

    ) {
        parent::__construct(FacebookPage::class);
    }

    public function getListAdminPage($accessToken)
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

    public function getAdminPageByPageId($pageId, $accessToken)
    {
        $fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.app_version'),
        ]);
        try {
            $response = $fb->get('/'.$pageId .'?fields=id,name,picture{url}', $accessToken);
        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $page = $response->getGraphNode();
        return $page;
    }
}
