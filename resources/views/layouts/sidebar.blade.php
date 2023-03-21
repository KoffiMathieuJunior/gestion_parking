<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
    <div class="position-sticky pt-md-3 sidebar-sticky">

        <div class="offset-1 col-10">
            <div class="my-5 border info rounded">
                <div class="d-inline-flex justify-content-around">
                    <div class="my-auto">
                        &nbsp;&nbsp;<i class="fa fa-user fa-2x" style="width: 90px"></i>
                    </div>
                    <div class="">
                        <h4 class="fw-bold p-0 m-0">VEHICULE 1</h4>
                        <div class="p-0 m-0">
                            Durée de reservation<br>
                            31/12/2022 au 20/01/23
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-pills flex-column offset-1 col-10">
            <li class="nav-item">
                <a class="nav-link active my-2 p-1 fw-bold" aria-current="page" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link my-2 bg-light p-1 fw-bold" href="#">USER</a>
            </li>
            <li class="nav-item">
                <a class="nav-link my-2 bg-light p-1 fw-bold" href="#">COMPAGNIE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link my-2 bg-light p-1 fw-bold" href="{{ route('users.index') }}">TYPE VEHICULE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link my-2 bg-light p-1 fw-bold">VEHICULE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link my-2 bg-light p-1 fw-bold">Administration</a>
            </li>
        </ul>
    </div>
</nav>