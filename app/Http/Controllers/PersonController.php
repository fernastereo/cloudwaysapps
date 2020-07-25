<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use Devio\Pipedrive\Pipedrive;

class PersonController extends Controller
{
    public function getOrganizations(){
        $token = env('PIPEDRIVE_TOKEN');
        $pipedrive = new Pipedrive($token);
        
        $organizations = $pipedrive->organizations->all()->getData();
        dd($organizations);
    }

    public function getPersons($id){
        $token = env('PIPEDRIVE_TOKEN');
        $pipedrive = new Pipedrive($token);
        
        $person = $pipedrive->persons->find($id)->getData();
        dd($person);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $token = env('PIPEDRIVE_TOKEN');
        $pipedrive = new Pipedrive($token);
        
        $person = $pipedrive->persons->find($id)->getData();
        $organizations = $pipedrive->organizations->all()->getData();
        //dd($organizations);
        
        return view('person.show', ['person' => $person, 'organizations' => $organizations]);
    }
}
