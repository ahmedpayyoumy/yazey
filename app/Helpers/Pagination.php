<?php
namespace App\Helpers;

class Pagination
{
    public static function initArray($c, $m)
    {
        $current = $c;
        $last = $m;
        $delta = 2;
        $left = $current - $delta;
        $right = $current + $delta + 1;
        $range = [];
        $rangeWithDots = [];
        $l = 0;
        for ($i = 1; $i <= $last; $i++) {
            if ($i == 1 || $i == $last || $i >= $left && $i < $right) {
                array_push($range, $i);
            }
        }
        foreach ($range as &$i) {
            if ($l) {
                if ($i - $l === 2) {
                    array_push($rangeWithDots, $l + 1);
                } elseif ($i - $l !== 1) {
                    array_push($rangeWithDots, '...');
                }
            }
            array_push($rangeWithDots, $i);
            $l = $i;
        }
        return $rangeWithDots;
    }

    public static function calSum($from, $to)
    {
        $sum = 0;
        for ($i = $from; $i <= $to; $i++) {
            $sum += $i;
        }
        return $sum;
    }

    public static function initFullPagination($total, $page, $take)
    {
        $totalPage = (int) ($total / $take) + (($total % $take) !== 0);
        $previousPage = ($page == 1) ? 1 : ($page - 1);
        $nextPage = ($page == $totalPage) ? $totalPage : ($page + 1);
        $listPages = Pagination::initArray($page, $totalPage);
        return (object)[
            'total_page' => $totalPage,
            'previous_page' => $previousPage,
            'next_page' => $nextPage,
            'list_pages' => $listPages
        ];
    }
}
