<?php
namespace App\Repositories;


Interface CommonRepositoryInterface{
    public function find($id);
    public function all();
    public function all_withTrashed();
    public function restore($id);
    public function destroy($id);
    public function only_TrashedItem($id);
}