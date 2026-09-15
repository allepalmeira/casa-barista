<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BannerController extends Controller
{
    // Listar todos os banners cadastrados
    public function index()
    {
        $listaBanner = Banner::orderByDesc('id_banner')->get();
        return view('admin.banner.index', compact('listaBanner'));
    }

    // CADASTRAR BANNER
    public function store(Request $request)
    {

        //dd($request);

        // 1 - Validar os dados
        $dados = $request->validate([
            'titulo_banner' => 'required|max:50',
            'imagem_banner' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_banner' => 'required|in:ATIVO,INATIVO'
        ]);

        $caminhoArquivo = null;

        try {

            DB::beginTransaction();


            // 2 - Cadastrar no banco de dados
            $banner = Banner::create([
                'titulo_banner' => $dados['titulo_banner'],
                
                // Valor temporario
                'imagem_banner' => 'banner/sem-foto.png',
                'status_banner' => $dados['status_banner'],
            ]);

            // 3 - Receber a imagem enviada
            $imagem = $request->file('imagem_banner');

            // 4 - Criar um nome para a imagem - Café Mineiro mudar para: cafe_mineiro_7.png
            $tituloImg = Str::slug($dados['titulo_banner']);

            // 5 - Pegar a extensao do arquivo
            $extensao = strtolower($imagem->getClientOriginalExtension());

            // 6- Criar nome FINAL           
            $nomeImg = $tituloImg . '_' . $banner->id_banner . '.' . $extensao;

            // 7 - Salvar a imagem
            $pasta = public_path('barista/img/banner');

            // 8 - Se a pasta não existir... faça:
            if(!is_dir($pasta)){
                mkdir($pasta, 0775, true);
            }

            // 9 - Mover e salvar a img na psta
            $imagem->move(
                $pasta,
                $nomeImg
            );

            $caminhoArquivo = $pasta . DIRECTORY_SEPARATOR . $nomeImg;

            // 10 - Atualizar o registro
            $banner->imagem_banner = 'banner/' . $nomeImg;
            $banner->save();
            
            DB::commit();
            
            // 11 - Voltar para a listagem
            return redirect()
                ->route('admin.banner.index')
                ->with('sucesso', 'Banner: ' . $banner->titulo_banner . ' foi cadastrado com sucesso!');


        } catch (\Throwable $erro) {

            DB::rollBack();

            if($caminhoArquivo && file_exists($caminhoArquivo)){
                unlink($caminhoArquivo);
            }

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o banner. Tente mais tarde!');
                
        }
    }
}
