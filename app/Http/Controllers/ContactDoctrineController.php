<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entities\Contacts;

class ContactDoctrineController extends Controller
{

    protected $em;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(EntityManagerInterface $em)
    {
        //$this->middleware('auth');
        $this->em = $em;
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = $this->em->getRepository(Contacts::class)->findAll();
        
        return view('contactsDoctrine.index', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contactsDoctrine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required'
        ]);

        $contact = new Contacts();
        $contact->setFirstName($request->get('first_name'));
        $contact->setLastName($request->get('last_name'));
        $contact->setEmail($request->get('email'));
        $contact->setJobTitle($request->get('job_title'));
        $contact->setCity($request->get('city'));
        $contact->setCountry($request->get('country'));

        $this->em->persist($contact);
        $this->em->flush();
        
        return redirect('/contacts-doctrine')->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = $this->em->getRepository(Contacts::class)->find($id);
        return view('contactsDoctrine.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required'
        ]);

        $contact = $this->em->getRepository(Contacts::class)->find($id);
        $contact->setFirstName($request->get('first_name'));
        $contact->setLastName($request->get('last_name'));
        $contact->setEmail($request->get('email'));
        $contact->setJobTitle($request->get('job_title'));
        $contact->setCity($request->get('city'));
        $contact->setCountry($request->get('country'));

        $this->em->persist($contact);
        $this->em->flush();
        
        return redirect('/contacts-doctrine')->with('success', 'Contact updated!');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = $this->em->getRepository(Contacts::class)->find($id);

        $this->em->remove($contact);
        $this->em->flush();
        
        return redirect('/contacts-doctrine')->with('success', 'Contact deleted!');          
    }
}
