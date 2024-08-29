<?php

namespace App\Http\Controllers;

use HubSpot\Client\Crm\Contacts\ApiException;
use Illuminate\Http\Request;
use HubSpot\Factory;

class HubSpotContactController extends Controller
{
    private $hubspot;

    public function __construct()
    {
        $this->hubspot = Factory::createWithAccessToken(env('HUBSPOT_ACCESS_TOKEN'));
    }

    public function index(Request $request)
    {
        try {
            $limit = 100; // The number of contacts to retrieve per request
            $after = null; // For pagination

            $allContacts = [];
            do {
                $response = $this->hubspot->crm()->contacts()->basicApi()->getPage($limit, $after);
                $contacts = $response->getResults();
                $allContacts = array_merge($allContacts, $contacts);

                $after = $response->getPaging() ? $response->getPaging()->getNext()->getAfter() : null;
            } while ($after);

            // Sort contacts in descending order by creation date (or any other field)
            usort($allContacts, function($a, $b) {
                return strtotime($b['properties']['createdate']) - strtotime($a['properties']['createdate']);
            });

            return view('allcontacts', ['contacts' => $allContacts]);
        } catch (ApiException $e) {
            return redirect()->back()->with('error', 'Failed to retrieve contacts: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $contactInput = [
                'properties' => [
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                ],
            ];

            $this->hubspot->crm()->contacts()->basicApi()->create($contactInput);
            return redirect()->back()->with('success', 'Contact added successfully!');
        } catch (ApiException $e) {
            return redirect()->back()->with('error', 'Failed to add contact: ' . $e->getMessage());
        }
    } 

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        try {
            $limit = 100; // The number of contacts to retrieve per request
            $after = null; // For pagination

            $allContacts = [];
            do {
                $response = $this->hubspot->crm()->contacts()->basicApi()->getPage($limit, $after);
                $contacts = $response->getResults();
                $allContacts = array_merge($allContacts, $contacts);

                $after = $response->getPaging() ? $response->getPaging()->getNext()->getAfter() : null;
            } while ($after);

            // Filter contacts based on the search query
            $filteredContacts = array_filter($allContacts, function($contact) use ($query) {
                $properties = $contact['properties'];
                $searchableFields = [
                    $properties['firstname'] ?? '',
                    $properties['lastname'] ?? '',
                    $properties['email'] ?? ''
                ];

                foreach ($searchableFields as $field) {
                    if (stripos($field, $query) !== false) {
                        return true;
                    }
                }

                return false;
            });

            // Sort filtered contacts in descending order by creation date (or any other field)
            usort($filteredContacts, function($a, $b) {
                return strtotime($b['properties']['createdate']) - strtotime($a['properties']['createdate']);
            });

            return view('allcontacts', ['contacts' => $filteredContacts]);

        } catch (ApiException $e) {
            return redirect()->back()->with('error', 'Failed to retrieve contacts: ' . $e->getMessage());
        }
    }

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->hubspot->crm()->contacts()->basicApi()->archive($id);
            return redirect()->back()->with('success', 'Contact deleted successfully!');
        } catch (ApiException $e) {
            return redirect()->back()->with('error', 'Failed to delete contact: ' . $e->getMessage());
        }
    }

    // Update Method
    public function update(Request $request, $id)
    {
        try {
            $contactInput = [
                'properties' => [
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                ],
            ];

            $this->hubspot->crm()->contacts()->basicApi()->update($id, $contactInput);
            return redirect()->back()->with('success', 'Contact updated successfully!');
        } catch (ApiException $e) {
            return redirect()->back()->with('error', 'Failed to update contact: ' . $e->getMessage());
        }
    }
}

