<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use http\Env\Response;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('cities.list', compact('cities'));
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        $city = new City();
        $city->name = $request->input('name');
        $city->save();

        Session::flash('success', 'Tạo mới thành công');

        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $city->name = $request->input('name');
        $city->save();

        Session::flash('success', 'Cập nhật thành công');

        return redirect()->route('cities.index');
    }


    public function destroy($id)
    {
        $city = City::findOrFail($id);

        $city->customers()->delete();
        $city->delete();

        Session::flash('success', 'Xóa  thành công');

        return redirect()->route('cities.index');
    }
}
