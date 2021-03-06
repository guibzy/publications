<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;

use App\Repositories\OrganisationRepository;
use App\Repositories\EquipeRepository;

use App\EloquentModels\Organisation;
use App\EloquentModels\Equipe;

use App\Repositories\CategorieRepository;
use App\EloquentModels\Categorie;

class UsersController extends Controller
{
    protected $userRepository;

    protected $nbrPerPage = 10;

    public function __construct(UserRepository $userRepository)
    {
	$this->userRepository = $userRepository;
        $this->middleware('admin', ['only' => 'destroy']);
        $this->middleware('guest');
    }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
    $users = $this->userRepository->getWithEquipePaginate($this->nbrPerPage);
  	$links = $users->render();
        
        $title = 'Chercheurs';

  	return view('users_liste', compact('users', 'links', 'title'));
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
      $user = $this->userRepository->getById($id);

      $equipeRep = new EquipeRepository($equipe_m = new Equipe());
      $organisationRep = new OrganisationRepository($organisation_m = new Organisation());
      $equipe = $equipeRep->getById($user->equipe);
      $organisation = $organisationRep->getById($equipe->organisation);

		  return view('users_show',  compact('user', 'organisation', 'equipe'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
      $this->userRepository->destroy($id);

      return redirect()->back();
  }

    public function publications($id)
    {
        $rep_categories = new CategorieRepository($categorie_m = new Categorie());
        $categories = $rep_categories->getAll();
            $categories_tab = array();
            foreach ($categories as $categorie) {
              $categories_tab[$categorie->sigle] = $categorie->name;
        }


        $publications = $this->userRepository->getById($id)->publications()->paginate($this->nbrPerPage);
        $links = $publications->render();

        $auteur = $this->userRepository->getById($id);
        $tabName = 'Publications de ' .$auteur->first_name . ' '. $auteur->name;

        return view('publication.publications_liste', compact('publications', 'categories_tab', 'tabName', 'links'));
    }
    
    public function collaboration($id)
    {
        $publications = $this->userRepository->getById($id)->publications()->get();
   
        
        $users_temp = array();
        foreach($publications as $pub)
        {
            array_push($users_temp, $pub->users()->where('users.id', '<>', $id )->get());
        }
        
        $users = array();
        foreach($users_temp as $user)
        {
            foreach ($user as $u)
            {
                array_push($users, $u->id);
            }           
        }
        
        $users = array_unique($users);
        $users = $this->userRepository->getMultipleUsersId($users);
        
        $title = 'Collaborateurs de '. $this->userRepository->getById($id)->first_name . ' '. $this->userRepository->getById($id)->name;
        return view('users_liste', compact('users', 'title'));
       
    }

}
