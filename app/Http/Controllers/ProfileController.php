<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::latest()->get();

        return view('home', ['profiles' => $profiles]);
    }

    public function show($id)
    {
        $profile = Profile::findOrFail($id);

        return view('show', ['profile' => $profile]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $profile = Profile::create($data);

        return redirect('/profiles/' . $profile->id);
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);

        return view('edit', ['profile' => $profile]);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $data = $this->validated($request);

        foreach ($data as $key => $value) {
            if ($value === null || $value === [] || $value === '') {
                unset($data[$key]);
            }
        }

        $profile->update($data);

        return redirect('/profiles/' . $profile->id);
    }

    public function destroy($id)
    {
        Profile::findOrFail($id)->delete();

        return redirect('/');
    }

    public function about()
    {
        return view('about');
    }

    public function spotlight()
    {
        $profile = Profile::inRandomOrder()->first();

        if ($profile === null) {
            return redirect('/');
        }

        return redirect('/profiles/' . $profile->id);
    }

    private function validated(Request $request)
    {
        $data = $request->validate([
            'name'     => 'nullable|string|max:100',
            'tagline'  => 'nullable|string|max:150',
            'bio'      => 'nullable|string|max:1000',
            'skills'   => 'nullable|string|max:500',
            'fun_fact' => 'nullable|string|max:300',
            'email'    => 'nullable|string|max:100',
            'github'   => 'nullable|string|max:100',
            'city'     => 'nullable|string|max:100',
        ]);

        if (! empty($data['skills'])) {
            $skills = array_filter(array_map('trim', explode(',', $data['skills'])));
            $data['skills'] = array_values($skills);
        } else {
            $data['skills'] = [];
        }

        if (empty($data['name'])) {
            $data['name'] = 'Someone';
        }

        return $data;
    }
}