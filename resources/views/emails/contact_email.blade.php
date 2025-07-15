<h1>Acl ...</h1>
<p><strong>Name :</strong> {{ $contact->name }}</p>
<p><strong>Email :</strong> {{ $contact->email }}</p>
<p><strong>Phone :</strong> {{ $contact->phone }}</p>
<p><strong>National ID :</strong> {{ $contact->national_id }}</p>
<p><strong>Type Reservation :</strong> {{ $contact->typereservation }}</p>
<p><strong>Doctor :</strong> {{ $contact->doctor }}</p>
<p><strong>Date :</strong> {{ $contact->date }}</p>
<p><strong>Service : </strong>{{$contact->service}}</p>
@if(isset($project_name) && $project_name)
<p><strong>Product :</strong> {{ $project_name }}</p>
@endif
@if(isset($service_name) && $service_name)
<p><strong>Service :</strong> {{ $service_name }}</p>
@endif
<p><strong>Message:</strong> {{ $contact->message }}</p>