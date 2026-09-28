<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private function path()
    {
        return storage_path('app/profile.json');
    }

    private function load()
    {
        $profile = [
            'name'    => 'Your Name',
            'tagline' => 'Fill me in on the Edit page.',
            'bio'     => '',
            'skills'  => [],
            'email'   => '',
            'github'  => '',
            'city'    => '',
        ];

        if (file_exists($this->path())) {
            $saved = json_decode(file_get_contents($this->path()), true);

            if (is_array($saved)) {
                $profile = array_merge($profile, $saved);
            }
        }

        return $profile;
    }

    public function home()
    {
        return view('home', ['profile' => $this->load()]);
    }

    public function skills()
    {
        return view('skills', ['profile' => $this->load()]);
    }

    public function contact()
    {
        return view('contact', ['profile' => $this->load()]);
    }

    public function edit()
    {
        return view('edit', ['profile' => $this->load()]);
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'tagline' => 'nullable|string|max:150',
            'bio'     => 'nullable|string|max:1000',
            'skills'  => 'nullable|string|max:500',
            'email'   => 'nullable|string|max:100',
            'github'  => 'nullable|string|max:100',
            'city'    => 'nullable|string|max:100',
        ]);

        // "PHP, HTML, CSS" becomes ['PHP', 'HTML', 'CSS']
        $skills = array_filter(array_map('trim', explode(',', $data['skills'] ?? '')));
        $data['skills'] = array_values($skills);

        file_put_contents($this->path(), json_encode($data));

        return redirect('/');
    }

    public function reset()
    {
        if (file_exists($this->path())) {
            unlink($this->path());
        }

        return redirect('/edit');
    }
}