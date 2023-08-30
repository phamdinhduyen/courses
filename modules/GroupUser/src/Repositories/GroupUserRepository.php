<?php
namespace Modules\GroupUser\src\Repositories;
use App\Repositories\BaseRepository;
use Modules\GroupUser\src\Models\GroupUser;
use Modules\GroupUser\src\Repositories\GroupUserRepositoryInterface;


class GroupUserRepository extends BaseRepository implements GroupUserRepositoryInterface
{
    public function getModel()
    {
        return GroupUser::class;
    }
    // public function getGroupUser(){
    //     return $this->model->with('subCategories')->whereParentId(0)->select(['id','name','slug','parent_id','created_at'])->latest();
    // }

    public function getAllGroupUser(){
        return $this->getAll();
    }

}