<x-layout>

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Book Your Appointment</p>
                        <h1>Reservation</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- reservation form -->
    <div class="reservation-form-section mt-150 mb-150">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title text-center">
                        <h2>Make a Reservation</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, ratione! Laboriosam est,
                            assumenda. Perferendis, quo alias quaerat aliquid. Corporis ipsum minus voluptate? Dolore,
                            esse natus!</p>
                    </div>
                    <div id="form_status"></div>
                    <div class="card shadow-lg p-4">
                        <div class="reservation-form">
                            <form type="POST" id="barbershop-reservation" onSubmit="return valid_datas( this );">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name" name="name" id="name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" class="form-control" placeholder="Phone" name="phone" id="phone">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="service" id="service">
                                                <option value="" disabled selected>Select Service</option>
                                                <option value="Haircut">Haircut</option>
                                                <option value="Shave">Shave</option>
                                                <option value="Trim">Trim</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="barberman" id="barberman">
                                                <option value="" disabled selected>Select Barberman</option>
                                                <option value="John">John</option>
                                                <option value="Mike">Mike</option>
                                                <option value="Steve">Steve</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="date" class="form-control" placeholder="Date" name="date" id="date">
                                        </div>
                                        <div class="form-group">
                                            <input type="time" class="form-control" placeholder="Time" name="time" id="time">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Price" name="price" id="price">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="FsWga4&@f6aw" />
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end reservation form -->



</x-layout>
