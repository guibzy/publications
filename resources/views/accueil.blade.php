@extends('template_base')

@section('titre')
Accueil
@stop

@section('head')
<link rel="stylesheet" href="css/base.css">
@stop

@section('blocgauche')
@stop

@section('contenu')
<br>
<div class="container">
   <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
            <h1 class="display-3">Les recherches de l'UTT</h1>
            <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <hr class="m-y-2">
            <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>

            <p class="lead">
              <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    </p>
</div>

    <div class="row">
      <div class="container">
        <div class="col-md-12" style="text-align: center">
        @if(count($publications)>2)
            <div class="panel panel-default">
                <div class="panel-body">
                  <h1>Les dernières publications</h1>

                  <hr>
                  <div class="col-md-4">
                    <div class="panel panel-default">
                      <a href={{url('/publication/'.$publications[0]['attributes']['id'])}}>
                        <div class="panel-body">
                          <h3>{{$publications[0]['attributes']['title']}}</h3>
                            <hr>
                            <p>{{$publications[0]['relations']['categorie']['attributes']['name']}}</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="panel panel-default">
                      <a href={{url('/publication/'.$publications[1]['attributes']['id'])}}>
                        <div class="panel-body">
                          <h3>{{$publications[1]['attributes']['title']}}</h3>
                          <hr>
                          <p>{{$publications[1]['relations']['categorie']['attributes']['name']}}</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="panel panel-default">
                      <a href={{url('/publication/'.$publications[2]['attributes']['id'])}}>
                        <div class="panel-body">
                          <h3>{{$publications[2]['attributes']['title']}}</h3>
                          <hr>
                          <p>{{$publications[2]['relations']['categorie']['attributes']['name']}}</p>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
            </div>
          @endif
          </div>
        </div>
    </div>
</div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
