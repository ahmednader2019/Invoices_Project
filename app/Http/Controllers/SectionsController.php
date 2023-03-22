<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Models\sections;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SectionsController extends Controller
{
    public function index()
    {
      $sections = sections::all();
      return view('sections.sections' , compact('sections'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request):RedirectResponse
    {
        Validator::make($request->all(), [
            'section_name' => 'required|unique:sections|max:255',
        ])->validate();
        $name = $request->section_name;
        $isExist = sections::where("section_name", $name )->exists();
        if(!$isExist)
        {
            try
            {
                $section = new sections();
                $section->section_name = $request->section_name;
                $section->description = $request->description;
                $section->Created_by = Auth::user()->name;
                $section->save();
                return redirect('sections');
            }
            catch(Exception $e){
             return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
          }
        }else{
            return redirect('sections');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sections $sections)
    {
          $section = sections::findorFail($request->id);
          try
            {
                $section->section_name = $request->section_name;
                $section->description = $request->description;
                $section->Created_by = Auth::user()->name;
                $section->save();
                return redirect('sections');
            }
            catch(Exception $e){
             return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        sections::destroy($id);
        return redirect('sections');
    }
}
