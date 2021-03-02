<?php
namespace App\Http\Controllers\Rol;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Rol\StoreRolRequest;
// Repositories
use App\Repositories\Rol\RolRepositories;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Menurole;

class RolController extends Controller {
  protected $rolRepo;
  public function __construct(RolRepositories $rolRepositories) {
    $this->rolRepo = $rolRepositories;
  }
  public function index(Request $request) {
    $sorter       = $request->sorter;
    $tableFilter  = $request->tableFilter;
    $columnFilter = $request->columnFilter;
    $itemsLimit   = $request->itemsLimit;
    $startDate    = $request->startDate;
    $endDate      = $request->endDate;
    $roles        = $this->rolRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

    return response()->json($roles,200);
  } 
  public function store(StoreRolRequest $request) {
    $rol = $this->rolRepo->store($request);
    return response()->json(['id'=>$rol->id],200);
    

    /*
    $request->validate([
        'name' => 'required|min:1|max:128'
    ]);
    $role = new Role();
    $role->nom = $request->input('name');
    $role->name = $request->input('name');
    $role->asig_reg = auth()->user()->email_registro;
    $role->created_at_reg = auth()->user()->email_registro;

    $role->save();
    $hierarchy = RoleHierarchy::select('hierarchy')
    ->orderBy('hierarchy', 'desc')->first();
    if(empty($hierarchy)){
        $hierarchy = 0;
    }else{
        $hierarchy = $hierarchy['hierarchy'];
    }
    $hierarchy = ((integer)$hierarchy) + 1;
    $roleHierarchy = new RoleHierarchy();
    $roleHierarchy->role_id = $role->id;
    $roleHierarchy->hierarchy = $hierarchy;
    $roleHierarchy->save();
    //$request->session()->flash('message', 'Successfully created role');
    return response()->json( ['status' => 'success'] );
    */
  }
  /*
  public function show($id) {
    $role = Role::where('id', '=', $id)->first();
    return response()->json( array('name' => $role->name) );
  }
  public function edit($id) {
    $role = Role::where('id', '=', $id)->first();
    return response()->json( array(
        'id' => $role->id,
        'name' => $role->name
    ));
  }
  */
  public function update(Request $request, $id) {
    /*
    $request->validate([
        'name' => 'required|min:1|max:128'
    ]);
    $role = Role::where('id', '=', $id)->first();
    $role->name = $request->input('name');
    $role->save();
    //$request->session()->flash('message', 'Successfully updated role');
    return response()->json( ['status' => 'success'] );
    */
  }
  public function destroy($id, Request $request) {
    /*
    $role = Role::where('id', '=', $id)->first();
    $roleHierarchy = RoleHierarchy::where('role_id', '=', $id)->first();
    $menuRole = Menurole::where('role_name', '=', $role->name)->first();
    if(!empty($menuRole)){
        return response()->json( ['status' => 'rejected'] );
    }else{
        $role->delete();
        $roleHierarchy->delete();
        return response()->json( ['status' => 'success'] );
    }
    */
    /*
  public function moveUp(Request $request){
    
    $element = RoleHierarchy::where('role_id', '=', $request->input('id'))->first();
    $switchElement = RoleHierarchy::where('hierarchy', '<', $element->hierarchy)
        ->orderBy('hierarchy', 'desc')->first();
    if(!empty($switchElement)){
        $temp = $element->hierarchy;
        $element->hierarchy = $switchElement->hierarchy;
        $switchElement->hierarchy = $temp;
        $element->save();
        $switchElement->save();
    }
    return response()->json( ['status' => 'success'] );
  }

  public function moveDown(Request $request){
    $element = RoleHierarchy::where('role_id', '=', $request->input('id'))->first();
    $switchElement = RoleHierarchy::where('hierarchy', '>', $element->hierarchy)
        ->orderBy('hierarchy', 'asc')->first();
    if(!empty($switchElement)){
        $temp = $element->hierarchy;
        $element->hierarchy = $switchElement->hierarchy;
        $switchElement->hierarchy = $temp;
        $element->save();
        $switchElement->save();
    }
    return response()->json( ['status' => 'success'] );
  }
  */
  }
}
