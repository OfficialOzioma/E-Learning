<style>
    button {
        background-color: #6b9dbb;
        color: white;
        padding: 5px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 30%;
    }
    button:hover {
        background: #2b2b2b;
    }
    .container {
        padding: 5px;
    }
</style>


<div class="well">
    <div class="row">

        <div class="col-lg-10">
            <p>{{auth()->guard('managers')->id()}}</p>
            <button onclick="window.location='//TODO Vie minut jonnekkin.'"> Keksi nimi </button>
            <form action="{{route('logout')}}" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>