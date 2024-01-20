<!DOCTYPE html>

<title>Author Page</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<body>
    @if ($action == 'create')
        <div class="container row">
            <div class="col-4">
                <h1>Create an Author</h1>
                <form method="post" action="{{ route('authors.store') }}">
                    @csrf
                    @method('post')
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" placeholder="name">
                    </div>
                    <div>
                        <label>Age</label>
                        <input type="text" name="age" placeholder="age">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="text" name="email" placeholder="email">
                    </div>
                    <div>
                        <label>Address</label>
                        <input type="text" name="address" placeholder="address">
                    </div>
                    <div>
                        <label>Sales</label>
                        <input type="text" name="sales" placeholder="sales">
                    </div>
                    <div>
                        <input type="submit">
                    </div>
                </form>
            </div>
            <div class="col-2">
                <a href="{{ route('index') }}"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: 7%;" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                </svg></a>
            </div>  
        </div>
    


    @elseif ($action == 'show')
        <div class="container row">
            <div class="col-4">
                <h1>{{ Str::ucfirst($action) }} an Author</h1>

                @foreach ($author->getAttributes() as $attribute => $value)
                <div>
                    <label>{{ Str::ucfirst($attribute)}}</label><br>
                    <input type="text" name="{{ $attribute }}" value="{{ $value }}" readonly>
                </div>
                <br>
                @endforeach
            </div>
            <div class="col-2">
                <a href="{{ route('index') }}"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: 7%;" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                </svg></a>
            </div>  
        </div>



    @elseif ($action == 'edit')
        <div class="container row">
            <div class="col-4">
                <form method="post" action="{{ route('authors.update',['id' => $author->getAttributes()['id']]) }}">
                    @csrf
                    @method('put')
                    <h1>{{ Str::ucfirst($action) }} an Author</h1>
                    @foreach ($author->getAttributes() as $attribute => $value)
                        <div>
                            <label>{{ Str::ucfirst($attribute)}}</label><br>
                            <input type="text" name="{{ $attribute }}" value="{{ $value }}">
                        </div>
                        <br>
                    @endforeach
                    <div>
                        <input type="submit" value="Update">
                    </div>
                </form>
            </div>
            <div class="col-2">
                <a href="{{ route('index') }}"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top: 7%;" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                </svg></a>
            </div>  
        </div>
    @endif
</body>



