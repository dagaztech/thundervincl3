<?php







namespace App\Http\Controllers;







use Illuminate\Http\Request;



use App\Models\Vin;



use App\Models\Historial_busqueda;



use App\Models\DetalleCampana;



use App\User;







use DB;



use ClassesWithParents\D;







class HomeController extends Controller



{



    /**



     * Create a new controller instance.



     *



     * @return void



     */



    public function __construct()



    {



        $this->middleware('auth', ['only' => 'admin']);



    }







    /**



     * Show the application dashboard.



     *



     * @return \Illuminate\Http\Response



     */



    public function index()



    {



        return view('frontend');



    }







    /**



     * Show the application dashboard.



     *



     * @return \Illuminate\Http\Response



     */



    public function audi()



    {



        return view('audi');



    }



   



    /**



     * Show the application dashboard.



     *



     * @return \Illuminate\Http\Response



     */



    public function seat()



    {



        return view('seat');



    }



   



    /**



     * Show the application dashboard.



     *



     * @return \Illuminate\Http\Response



     */



    public function skoda()



    {



        return view('skoda');



    }



   



    /**



     * Show the application dashboard.



     *



     * @return \Illuminate\Http\Response



     */



    public function volkswagen_pkw()



    {



        return view('volkswagen_pkw');



    }

   



    /**



     * Show the application dashboard.



     *



     * @return \Illuminate\Http\Response



     */



    public function volkswagen_lcv()



    {



        return view('volkswagen_lcv');



    }



    /**



     * Show the application dashboard.



     *



     * @return \Illuminate\Http\Response



     */



    public function volkswagen_tyb()



    {


        return view('volkswagen_tyb');



    }



/**/
public function man()



{


    return view('man');



}



    /**



     * Show the application dashboard.



     *



     * @return \Illuminate\Http\Response



     */



    public function admin()

    {

	

        $consultas = Historial_busqueda::all()->count();



        $c_exitosas = Historial_busqueda::where('estado', 1)->count();

		

        $consultas1 = Historial_busqueda::whereMonth('created_at', '=', date('m'))->count();



        $c_exitosas1 = Historial_busqueda::where('estado', 1)->whereMonth('created_at', '=', date('m'))->count();



        return view('home')->with(['consultas' => $consultas, 'c_exitosas' => $c_exitosas, 'consultas1' => $consultas1, 'c_exitosas1' => $c_exitosas1]);



    }



}



