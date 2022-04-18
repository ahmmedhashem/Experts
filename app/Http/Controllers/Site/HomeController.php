<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Main_criteria;
use App\Models\Role;
use App\Models\Activitie;
use App\Http\Requests\Site\SearchRequest;


class HomeController extends Controller
{
    public function index(){
        $data['datas'] =  Data::with(['activity' => function($act) {
            $act -> with('criteria');
        },'mission' => function($mis) {
            $mis -> with('rule');
        }]) -> active() -> orderBy('id','DESC') -> paginate(PAGINATION_COUNT);

        $data['main_criteria'] = Main_criteria::active()->orderBy('id','DESC') -> get();
        $data['rules'] = Role::active()->orderBy('id','DESC') -> get();
        // return $datas;

        return view('site.home',$data);
    }

    public function search(SearchRequest $request) {
        try {

            $data['datas'] =  Data::where('activity_id',$request -> activity_id) -> where('rule_id', $request -> rule_id) -> active() -> with(['activity' => function($act) {
                $act -> with('criteria');
            },'mission' => function($mis) {
                $mis -> with('rule');
            }]) -> orderBy('id','DESC') -> paginate(PAGINATION_COUNT);

            return view('site.home',$data);

        } catch (\Exception $ex) {
            return redirect()->route('home')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function getActivitiesByCriteria(Request $request) {
        $data['activities'] = Activitie::active()->where("criteria_id",$request->criteria_id)->get();
        return response()->json($data);
    }
}
