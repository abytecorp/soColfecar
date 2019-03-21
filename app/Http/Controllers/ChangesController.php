<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Change;
use Auth;

class ChangesController extends Controller
{
    public function regChange(Request $request, $desc, $item)
    {
        // return 'desc: '.$desc.' item: '.$item;
        if($request->ajax()){
            
            $change = new Change;
            $change->description = $desc; 
            $change->id_user = Auth::user()->id;
            $change->id_item = $item;
            $change->save();
            return 'el registro se realizo correctamente';
        }
    }
    public function getChangesByItem($item)
    {
        $changes = Change::select('changes.id','changes.description','changes.created_at','changes.id_user AS user_id',
            'changes.id_item','users.name','users.last_name','users.avtr')
                ->join('users', 'users.id','=','changes.id_user')
                ->where('changes.id_item',$item)
                ->latest()
                ->take(10)
                ->orderBy('changes.created_at','DESC')->get();
        return $changes;
    }
    public function getChangesByMonth($currentDate,$initDate,$item_id)
    {
        $changes = Change::select('changes.id','changes.description','changes.created_at','changes.id_user AS user_id',
            'changes.id_item','users.name','users.last_name','users.avtr')
            ->join('users', 'users.id','=','changes.id_user')
            ->whereBetween('changes.created_at', [$initDate,$currentDate])
            ->where('id_item',$item_id)
            ->orderBy('changes.created_at','DESC')->get();
        return $changes;
    }
    public function getChangesByUser($user)
    {
        $changes = Change::select('changes.id','changes.description','changes.created_at','changes.id_user AS user_id',
            'changes.id_item','users.name','users.last_name','users.avtr')
                ->join('users', 'users.id','=','changes.id_user')
                ->where('changes.id_user',$user)
                ->latest()
                ->take(10)
                ->orderBy('changes.created_at','DESC')->get();
        return $changes;
    }
}
