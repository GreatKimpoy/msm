

<style>

    .asterisks{
        color: red;
         font-size: 20px;
    }

    .labely{
        margin-top: 10px;
    }


    #plate{
        margin-left: 250px;
        margin-bottom: 20px;
    }

</style>




<div class="row">

    <div class="col-md-4">
        <label for="lastname">Lastname</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="Lastname" 
                maxlength="50" 
                required 
                name="lastname" 
                type="text"
                id="lastname"
                value="{{ isset($customer->lastname) ? $customer->lastname : old('lastname') }}">
        </div>
    </div>

    <div class="col-md-4">
        <label for="firstname">Firstname</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="Firstname" 
                maxlength="50" 
                required 
                name="firstname" 
                type="text"
                id="firstname"
                value="{{ isset($customer->firstname) ? $customer->firstname : old('firstname') }}">
        </div>
    </div>

    <div class="col-md-4">
        <label for="middlename">Middlename</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="Middlename" 
                maxlength="50" 
                name="middlename" 
                type="text"
                id="middlename"
                value="{{ isset($customer->middlename) ? $customer->middlename : old('middlename') }}">
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-4">
        <label for="birthdate" class="labely">Birthdate</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="Birthdate" 
                maxlength="50" 
                required 
                name="birthdate" 
                type="date"
                id="birthdate"
                value="{{ isset($customer->birthdate) ? $customer->birthdate : old('birthdate') }}">
        </div>
    </div>

    <div class="col-md-4">
        <label for="contact" class="labely">Contact Number</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-mobile"></i></span>
            </div>
           <input 
                class="form-control align-center" 
                placeholder="Contact Number" 
                maxlength="50" 
                required 
                name="contact" 
                type="text"
                id="contact"
                value="{{ isset($customer->contact) ? $customer->contact : old('contact') }}">
        </div>
    </div>

    <div class="col-md-4">
        <label for="email" class="labely">Email Address</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-at"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="Email Address" 
                maxlength="50" 
                required 
                name="email" 
                type="email"
                id="email"
                value="{{ isset($customer->email) ? $customer->email : old('email') }}">
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-4">
        <label for="barangay" class="labely">Barangay</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="Barangay" 
                maxlength="50" 
                required 
                name="barangay" 
                type="text"
                id="barangay"
                value="{{ isset($customer->barangay) ? $customer->barangay : old('barangay') }}">
        </div>
    </div>

    <div class="col-md-4">
        <label for="street" class="labely">Street</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="Street" 
                maxlength="50" 
                required 
                name="street" 
                type="text"
                id="street"
                value="{{ isset($customer->street) ? $customer->street : old('street') }}">
        </div>
    </div>

    <div class="col-md-4">
        <label for="city" class="labely">City</label><span class="asterisks"><strong>*</strong></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="City" 
                maxlength="50" 
                required 
                name="city" 
                type="text"
                id="city"
                value="{{ isset($customer->city) ? $customer->city : old('city') }}">
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6" id="plate">
       <label for="platenumber" class="labely">Plate Number</label><span></span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-car-side"></i></span>
            </div>
            <input 
                class="form-control align-center" 
                placeholder="Plate number" 
                maxlength="50" 
                name="plate_number" 
                type="text"
                id="plate_number"
                value="{{ isset($person_vehicle->plate_number) ? $person_vehicle->plate_number : old('person_number') }}">
        </div>
    </div>
</div>