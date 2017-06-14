<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;


class VoyagerFundingsController extends Controller
{
    use BreadRelationshipParser;

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('browse_' . $dataType->name);

        $getter = $dataType->server_side ? 'paginate' : 'get';

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $relationships = $this->getRelationships($dataType);
            if ($model->timestamps) {
                $status=$request->get('status');
                if(isset($status)){
                    $dataTypeContent = call_user_func([$model->with($relationships)->where([['status',$status]])->latest(), $getter]);
                }else{
                    $dataTypeContent = call_user_func([$model->with($relationships)->latest(), $getter]);
                }
            } else {
                $dataTypeContent = call_user_func([
                    $model->with($relationships)->orderBy($model->getKeyName(), 'DESC'),
                    $getter,
                ]);
            }

            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model           = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    /**
     * 审核配资
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function funding(Request $request, $id)
    {
        //当前管理员id
        $administrator_id = auth('admin')->id();
        if (empty($administrator_id)) {
            return redirect()
                ->route("voyager.fundings.index")
                ->with([
                    'message' => "审核失败!",
                    'alert-type' => 'error',
                ]);
        }
        //修改表数据
        $update_result = \DB::table('fundings')
            ->where([['id', $id]])
            ->update(['administrator_id' => $administrator_id, 'comply_at' => date('Y-m-d H:i:s', time()), 'status' => 1]);
        if ($update_result === false) {
            return redirect()
                ->route("voyager.fundings.index")
                ->with([
                    'message' => "审核失败!",
                    'alert-type' => 'error',
                ]);
        }
        return redirect()
            ->route("voyager.fundings.index")
            ->with([
                'message' => "审核成功!",
                'alert-type' => 'success',
            ]);
    }


}