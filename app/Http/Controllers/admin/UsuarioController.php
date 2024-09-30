<?php

namespace App\Http\Controllers\admin;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Services\EmailService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;

class UsuarioController extends Controller
{


    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Exibe a lista de usuários.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $usuarios =  Usuario::paginate(15); // ou Servico::paginate(10);
        return view('admin/usuario/grid', compact('usuarios'));

    }

    /**
     * Mostra o formulário de criação de um novo usuário.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna a view 'form' para criar um novo usuário
        return view('admin.usuario.create');
    }

    /**
     * Armazena um novo usuário no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUsuarioRequest $request)
    {
        // Prepara os dados do usuário e criptografa a senha antes de salvar
        $usuarioData = $request->all();
        $usuarioData['senha'] = bcrypt('saude@123');

        // Cria o novo usuário no banco de dados
        $usuario = Usuario::create($usuarioData);

        // Decodifica o JSON contendo os contatos
        $contatos = json_decode($usuario->contato, true);

        // Verifica se o JSON foi decodificado corretamente e é um array
        if (is_array($contatos)) {
            // Filtra apenas os contatos do tipo "Email"
            $emails = array_filter($contatos, function($contato) {
                return isset($contato['tipo']) && $contato['tipo'] === 'Email';
            });

            // Envia e-mails para os contatos filtrados
            foreach ($emails as $email) {
                $emailAddress = $email['descricao']; // O campo onde o e-mail está armazenado

                // Preparando dados para o e-mail
                $data = [
                    'title' => 'Bem-vindo!',
                    'content' => 'Seu cadastro foi realizado com sucesso.'
                ];

                // Envia o e-mail utilizando o serviço
                $this->emailService->sendEmail($emailAddress, 'Cadastro Realizado', 'emails.generic', $data);
            }
        }

        // Redireciona para a lista de usuários com uma mensagem de sucesso
        return redirect()->route('usuario.index')->with('success', 'Usuário criado com sucesso.');
    }



    /**
     * Exibe um usuário específico.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\View\View
     */
    public function show(Usuario $usuario)
    {

     // Converte o JSON para um array
    $contatoArray = json_decode($usuario->contato, true);

    // Retorna a view 'show' com os dados do usuário e do contato
    return view('admin.usuario.show', compact('usuario', 'contatoArray'));
    }

    /**
     * Mostra o formulário de edição de um usuário.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\View\View
     */
    public function edit(Usuario $usuario)
    {
        // Retorna a view 'edit' com os dados do usuário para edição
        return view('admin.usuario.edit', compact('usuario'));
    }

    /**
     * Atualiza um usuário existente no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUsuarioRequest $request, Usuario $usuario)
    {
            // Prepara os dados do usuário para atualização
            $usuarioData = $request->all();

            // Atualiza a senha apenas se for fornecida
            if ($request->filled('resetar_senha') == 'S') {
                $Senha = 'S@uade'.date('Y');
                $usuarioData['senha'] = bcrypt($Senha);
            }

            // Decodifica o JSON contendo os contatos
            $contatos = json_decode($usuario->contato, true);

            // Verifica se o JSON foi decodificado corretamente e é um array
            if (is_array($contatos)) {
                // Filtra apenas os contatos do tipo "Email"
                $emails = array_filter($contatos, function($contato) {
                    return isset($contato['tipo']) && $contato['tipo'] === 'Email';
                });

                // Envia e-mails para os contatos filtrados
                foreach ($emails as $email) {
                    $emailAddress = $email['descricao']; // O campo onde o e-mail está armazenado

                    // Preparando dados para o e-mail
                    $data = [
                        'title' => 'Atualização de Cadastro',
                        'content' => 'Seu cadastro foi atualizado com sucesso.'
                    ];

                    // Envia o e-mail utilizando o serviço
                    $this->emailService->sendEmail($emailAddress, 'Cadastro Atualizado', 'emails.generic', $data);
                }
            }

            // Atualiza o usuário no banco de dados
            $usuario->update($usuarioData);

            // Redireciona para a lista de usuários com uma mensagem de sucesso
            return redirect()->route('usuario.index')->with('success', 'Usuário atualizado com sucesso.');
    }


    /**
     * Remove um usuário do banco de dados.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Usuario $usuario)
    {
        // Deleta o usuário do banco de dados
        $usuario->delete();

        // Redireciona para a lista de usuários com uma mensagem de sucesso
        return redirect()->route('usuarios.index')->with('success', 'Usuário removido com sucesso.');
    }
}
