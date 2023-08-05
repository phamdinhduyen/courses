<?php 
namespace Modules\User\src\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Request\UserRequests;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    public function index(){
        $pageTitle = 'Quản lý người dùng';
        return view('user::lists', compact('pageTitle'));
    }

        public function data(){
        $users = $this->userRepository->getAllUsers();
        return DataTables::of($users)
            ->addColumn('edit', function ($user) {
                return '<a href="'.route('admin.users.edit', $user->id).'" class="btn btn-warning">Sửa</a> ';
            })
            ->addColumn('delete', function ($user) {
                return '<a href="#" class="btn btn-danger">Xóa</a>';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])  
        ->toJson();
    }
    public function create(){
        $pageTitle = 'Thêm người dùng';
        return view('user::add', compact('pageTitle'));
    }

    public function store(UserRequest $request){
        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => $request->password
        ]);
        return redirect()->route('admin.users.index')->with('msg', __('user::messages.create.success'));
    }

    public function edit($id){
        $user = $this->userRepository->find($id);
        if(!$user) {
            abort(404);
        }
        $pageTitle = 'Chỉnh sửa người dùng';
        return view('user::edit', compact('pageTitle', 'user'));
    }

    public function update(UserRequest $request, $id){
        $data = $request->except('_token','password');
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $this->userRepository->update($id,$data);
        return back()->with('msg', __('user::messages.update.success'));
        
    }

}