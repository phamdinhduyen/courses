<?php 
namespace Modules\User\src\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Modules\GroupUser\src\Repositories\GroupUserRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepositoryInterface;


class UserController extends Controller
{
    protected $userRepository;
    protected $groupUserRepository;
    public function __construct(
    UserRepositoryInterface $userRepository,
    GroupUserRepositoryInterface $groupUserRepository){
        $this->userRepository = $userRepository;
        $this->groupUserRepository = $groupUserRepository;
    }
    public function index(){
        $pageTitle = 'Quản lý người dùng';
        return view('user::lists', compact('pageTitle'));
    }

        public function data(){
        $users = $this->userRepository->getAllUsers();
        // dd( $users);
        return DataTables::of($users)
            ->addColumn('edit', function ($user) {
                return '<a href="'.route('admin.users.edit', $user->id).'" class="btn btn-warning">Sửa</a> ';
            })
            ->addColumn('delete', function ($user) {
                return '<a href="'.route('admin.users.delete', $user->id).'" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])  
        ->toJson();
    }
    public function create(){
        $pageTitle = 'Thêm người dùng';
        $groupUser = $this->groupUserRepository->getAllGroupUser();
        return view('user::add', compact('pageTitle','groupUser'));
    }

    public function store(UserRequest $request){
        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.users.index')->with('msg', __('user::messages.create.success'));
    }

    public function edit($id){
        $user = $this->userRepository->find($id);
        $groupUser = $this->groupUserRepository->getAllGroupUser();
        if(!$user) {
            abort(404);
        }
        $pageTitle = 'Chỉnh sửa người dùng';
        return view('user::edit', compact('pageTitle', 'user', 'groupUser'));
    }

    public function update(UserRequest $request, $id){
        $data = $request->except('_token','password');
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $this->userRepository->update($id,$data);
        return back()->with('msg', __('user::messages.update.success'));
        
    }
    public function delete($id){
         $this->userRepository->delete($id);
        return back()->with('msg', __('user::messages.delete.success'));
    }

}