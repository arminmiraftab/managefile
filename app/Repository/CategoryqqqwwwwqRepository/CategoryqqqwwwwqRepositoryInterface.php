<?php

namespace App\Repository\CategoryqqqwwwwqRepository;

interface CategoryqqqwwwwqRepositoryInterface
{
    public function index();
    public function find($id);
    public function show($id);
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}