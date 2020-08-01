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
     * @param  $id
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

    /**
     * Display schedule meeting form.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function schedule($personid, $organizationid){
        $token = env('PIPEDRIVE_TOKEN');
        $pipedrive = new Pipedrive($token);
        
        $person = $pipedrive->persons->find($personid)->getData();
        $organization = $pipedrive->organizations->find($organizationid)->getData();
        
        return view('person.schedule', ['person' => $person, 'organizations' => $organization]);
    }

    public function personsforupdate($start){
        $token = env('PIPEDRIVE_TOKEN');
        $pipedrive = new Pipedrive($token);

        $persons = $this->getPersons2(50, $start);
        foreach ($persons as $person) {
            if (is_null($person['95b1079caeebef34531a005163806761856fc2a6'])) {
                # code...
                $pipedrive->persons->update($person['id'], ['95b1079caeebef34531a005163806761856fc2a6' => 'http://schedule.aduresourcecenter.com/person/' . $person['id']]);
            }
        }
        return view('person.person', ['persons' => $persons]);
    }

    /**
     * @param int $limit Items shown per page (how many persons retrieved per request, you can change this number)
     * @param int $start Pagination start (how many persons will be skipped from the beginning of the full person list)
     * @return array
     */
    function getPersons2($limit = 100, $start = 0) {
        echo "Getting Persons, limit: $limit, start: $start"  . PHP_EOL;

        // Here's the URL you're sending this request to
        $url = 'https://' . env('COMPANY_DOMAIN') . '.pipedrive.com/api/v1/persons?api_token='
            . env('PIPEDRIVE_TOKEN') . '&start=' . $start . '&limit=' . $limit;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        echo 'Sending request...' . PHP_EOL;
        
        $output = curl_exec($ch);
        curl_close($ch);
        
        // Create an array from the data that is sent back from the API
        // As the original content from server is in JSON format, you need to convert it to PHP array
        $result = json_decode($output, true);
        $persons = [];

        // If the result is not empty, then add each person into the persons array
        if (!empty($result['data'])) {
            foreach ($result['data'] as $person) {
                $persons[] = $person;
            }
        } else {
            // If you have no persons in your company, then print out the whole response
            print_r($result);
        }

        // If the value of 'more_items_in_collection' is true, then the function calls itself
        // with an increased value for the 'start' parameter (retrieved from the previous request response)
        // if (!empty($result['additional_data']['pagination']['more_items_in_collection'] 
        //     && $result['additional_data']['pagination']['more_items_in_collection'] === true)
        // ) {
        //     // Merges persons found from the current request with the ones from the next request
        //     $persons = array_merge($persons, $this->getPersons2($limit, $result['additional_data']['pagination']['next_start']));
        // }
        return $persons;
    }

}
