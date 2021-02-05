<?php
namespace  App;
class Search
{
    public $filter;
    public function getAds()
    {
        $ads=Ads::with(['getFirstImage','getOstanName','getShahrName','getFilter.filter_parent']);
        $filter_id=$this->getAdsFormFilter();
        if(sizeof($filter_id)>0){
            $ads->whereIn('id',$filter_id);
        }
        $ads=$ads->orderBy('created_at','DESC');
        if(!empty($this->filter) && empty($filter_id)){
            return [];
        }
        else{
            return $ads->get();
        }
    }
    public function getAdsFormFilter()
    {
        $id_list=array();
        if(is_array($this->filter))
        {
            foreach ($this->filter as $key=>$value)
            {
                if(is_array($value)){
                    if(sizeof($value)==2  && (!empty($value[0]) || !empty($value[1]))  )
                    {

                        $ids=AdsFilter::orderBy('id','ASC');
                        if(!empty($value[0])){
                            settype($value[0],'integer');
                            $ids=$ids->where('filter_id',$key)->where('filter_value','>=',$value[0]);
                        }
                        if(!empty($value[1])){
                            settype($value[1],'integer');
                            $ids=$ids->where('filter_id',$key)->where('filter_value','<=',$value[1]);
                        }
                        $ids=$ids->pluck('ads_id','id')->toArray();
                        $id_list[$key]=$ids;
                    }


                }
                else{
                    if(!empty($value)){

                        $ids=AdsFilter::where(['filter_id'=>$key,'filter_value'=>$value])->pluck('ads_id','id')->toArray();
                        $id_list[$key]=$ids;
                    }
                }
            }

            if(sizeof($id_list)>1)
            {
                $id=call_user_func_array('array_intersect',$id_list);
                return $id;
            }
            else{

                $id=collect($id_list);
                return $id->values()->all()[0];
            }

        }
        else
        {
            return $id_list;
        }
    }
}
