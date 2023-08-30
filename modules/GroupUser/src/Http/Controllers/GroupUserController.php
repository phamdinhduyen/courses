<?php 
namespace Modules\GroupUser\src\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Modules\GroupUser\src\Http\Requests\GroupUserRequest;
use Yajra\DataTables\Facades\DataTables;
// use Modules\Categories\src\Models\Category;
use Modules\GroupUser\src\Repositories\GroupUserRepositoryInterface;

class GroupUserController extends Controller
{
    protected $groupUserRepository;
    public function __construct(GroupUserRepositoryInterface  $groupUserRepository){
        $this-> groupUserRepository = $groupUserRepository;
    }
    public function index(){
        $pageTitle = 'Quản lý nhóm thành viên';
        return view('groupuser::lists', compact('pageTitle'));
    }

    public function create(){
        $pageTitle = 'Thêm nhóm thành viên';
        return view('groupuser::add', compact('pageTitle'));
    }

    

    public function data(){
      $groupUsers = $this->groupUserRepository->getAllGroupUser();
        return DataTables::of($groupUsers)
         ->addColumn('edit', function ($groupUser) {
                return '<a href="' . route('admin.group_user.edit', $groupUser->id) . '" class="btn btn-warning">Sửa</a> ';
            })
            ->addColumn('delete', function ($groupUser) {
                return '<a href="' . route('admin.group_user.delete', $groupUser->id) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($groupUser) {
                return Carbon::parse($groupUser->created_at)->format('d/m/y H:i:s');
            })
       ->rawColumns(['edit', 'delete'])  
        ->toJson();
    }

    public function store(GroupUserRequest $request){
        $this->groupUserRepository->create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.group_user.index')->with('msg', __('groupuser::messages.create.success'));
    }

    public function edit($id){
        $groupUser = $this->groupUserRepository->find($id);
        if(!$groupUser) {
            abort(404);
        }
        $pageTitle = 'Chỉnh sửa nhóm thành viên';
        return view('groupuser::edit', compact('pageTitle', 'groupUser'));
    }

    public function update(GroupUserRequest $request, $id){
        $data = $request->except('_token');
        $this->groupUserRepository->update($id,$data);
        return back()->with('msg', __('groupuser::messages.update.success'));
        
    }
    public function delete($id){
        $this->groupUserRepository->delete($id);
        return back()->with('msg', __('groupuser::messages.delete.success'));
    }
}