<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /*
     * 格式化返回
     */
    public static function apiJson($data = [], $status = 'success', $message = '')
    {
        $response_data['data'] = $data;
        $response_data['status'] = $status;
        $response_data['message'] = $message;
        return response()->json($response_data);
    }

    public function findNewsList(Request $request)
    {
        $type = $request->get('type', 'stock');
        $reponse_data = \DB::table('newslists')
            ->select('title', 'created_at', 'type')
            ->where('type', $type)
            ->orderBy('created_at')
            ->limit(8)
            ->get();
        return static::apiJson($reponse_data);
    }

    /**
     * 是否登录
     * @return \Illuminate\Http\JsonResponse
     */
    public function homeIslogin()
    {
        if (\Auth::check()) {
            return static::apiJson(['phone'=>\Auth::user()->phone], 'success', '已经登录!');
        }
        return static::apiJson([], 'failed', '未登录!');
    }


    public function index()
    {
        //获取最新5条股票资讯
        $stock_data = \DB::table('newslists')
            ->where('type', 'stock')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
        //获取最新5条期货资讯
        $futures_data = \DB::table('newslists')
            ->where('type', 'futures')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
        //配资技巧
        $skill_data =\DB::table('newslists')
                ->where('type', 'skill')
                ->orderBy('created_at', 'DESC')
                ->limit(7)
                ->get();
        //公司优势
        $company_data =\DB::table('newslists')
            ->where('type', 'company')
            ->orderBy('created_at', 'DESC')
            ->limit(7)
            ->get();
        //机构评论
        $discuss_data =\DB::table('newslists')
            ->where('type', 'discuss')
            ->orderBy('created_at', 'DESC')
            ->limit(7)
            ->get();
        //期货配资
        $funding_data =\DB::table('newslists')
            ->where('type', 'funding')
            ->orderBy('created_at', 'DESC')
            ->limit(8)
            ->get();
        //名家观点
        $famous_data =\DB::table('newslists')
            ->where('type', 'famous')
            ->orderBy('created_at', 'DESC')
            ->limit(8)
            ->get();
        return view('home.index', compact('stock_data', 'futures_data','skill_data','company_data','discuss_data','funding_data','famous_data'));
    }

    /**
     * 获取详情
     * @param Request $request
     * @param $type
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDetails(Request $request, $type, $id)
    {
        //获取内容
        $news = \DB::table('newslists')
            ->where('id', $id)
            ->first();
        //更新点击数
        $save_result = \DB::table('newslists')
            ->where('id', $id)
            ->increment('count');
        //获取上一篇
        $previous_news = \DB::table('newslists')
            ->where([['created_at', '<', $news->created_at], ['type', $type]])
            ->first();
        //获取下一篇
        $next_news = \DB::table('newslists')
            ->where([['created_at', '>', $news->created_at], ['type', $type]])
            ->first();
        //获取相关列表
        $list = \DB::table('newslists')
            ->where('type', $type)
            ->limit(8)
            ->get();
        return view('home.xiangqing', compact('news', 'previous_news', 'next_news', 'list'));
    }

    /**
     * 获取列表
     * @param Request $request
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList(Request $request,$type){
        //获取列表
        $list=\DB::table('newslists')
            ->where('type', $type)
            ->limit(15)
            ->get();
        return view('home.gpzixun',compact('list','type'));
    }

    /**
     * 获取列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInvestmentList(Request $request){
        //获取列表
        $list=\DB::table('newslists')
            ->where('type', 'investment')
            ->limit(15)
            ->get();
        $type='investment';
        return view('home.tzxy',compact('list','type'));
    }
}
