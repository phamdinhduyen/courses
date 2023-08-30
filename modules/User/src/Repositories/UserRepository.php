<?php
namespace Modules\User\src\Repositories;
use Modules\User\src\Models\User;
use App\Repositories\BaseRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
public function getModel()
{
return User::class;
}

public function getUsers($limit){
    return $this->model->paginate($limit);
}
public function getAllUsers(){
    return $this->model->leftJoin('group_user', 'group_user.id', '=', 'users.group_id')->select(['users.id','users.name','users.email','group_user.name as groupName','users.created_at' ])->latest();
}

public function setPassword($password, $id){
    return $this->update($id, ['password' => hash::make($password)]);
}

public function checkPassword($password, $id){
        $user = $this->find($id);
        if($user){
            $hashPassword = $user->password;
            return Hash::check($password, $hashPassword);
        }
        return false;
}
}