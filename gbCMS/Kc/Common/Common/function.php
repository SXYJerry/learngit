<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-1-17
 * Time: 下午5:27
 */

/**
 * 获取文档模型信息
 * @param $cateName 栏目名称||栏目编号
 * @return mixed
 */
function get_cate($cateName){
    $cate= new \Admin\Model\CateModel();
    if(is_numeric($cateName)){
        $row = $cate->where(['id'=>$cateName])->find();
    }else{
        $row = $cate->where(['cindex'=>$cateName])->find();
    }
    $modelArray = json_decode($row['model']);
    $arr = ['id'=>['IN',$modelArray]];
    $model = D('Model');
    $modelName = $model->field('name')->where($arr)->select();  //查询模型名称列表
    $row['model'] =$modelName;
    return $row;
    //return ['name'=>'Article'];
}

/**获取栏目对应模型的名称
 * @param int $cate 栏目名称
 * @return mixed 模型名称数组
 */
function get_cate_Model($cate=1){
    $cateModel= new \Admin\Model\CateModel();   //带增加根据唯一标识获取信息
    $row = $cateModel->field('model')->where(['id'=>$cate])->find();
    $modelArray = json_decode($row['model']);
    $arr = ['id'=>['IN',$modelArray]];
    //$modelArray['_logic'] = "OR";
    $model = D('Model');
    $modelInfo =$model->field('id,name,identity')->where($arr)->select();
    return $modelInfo;

}

/**获取模型信息
 * @param $mid
 * @return mixed
 */
function get_model_info($mid){  //带增加根据唯一标识获取信息
    $model = D('model');
    //$model->id=$mid;
    return $model->find($mid);
}

/**获取所有文档模型的id,name
 * @param int $status
 * @return mixed
 */
function get_all_model($status=1){
    $model = D('model');
    return $model->query("select id,`name` from model WHERE status = {$status}");
}

function cate_atc_get($id){
    $model = new \Think\Model();
    $row = $model->query("select id,title,model_id,cate,atc_id,status,createtime from cate_atc WHERE id = {$id}");
    return $row[0];
}
function get_difftime_model($time,$format)
{
	$zero1=strtotime($time);
	$zero2=strtotime(date('Y-m-d h:i:s'));
	
	$diff=$zero2-$zero1;
	$str=date($format,$diff)."前";
	
	
}
