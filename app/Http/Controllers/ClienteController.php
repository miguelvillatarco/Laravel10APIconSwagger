<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

/**
* @OA\Info(
*             title="API clientes youtube",
*             version="1.0",
*             description="Listado de las URI´s de la API Clientes"
* )
*
* @OA\Server(url="http://localhost/apiLaravelVersion10/public")
*/
class ClienteController extends Controller
{
    /**
     * Listado de todos los registros de los clientes
     * @OA\Get (
     *     path="/api/clientes",
     *     tags={"Cliente"},
     *     @OA\Response(
     *         response=200,
     *         description="ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombres",
     *                         type="string",
     *                         example="Pedro Felix"
     *                     ),
     *                     @OA\Property(
     *                         property="apellido",
     *                         type="string",
     *                         example="Perez"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2024-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2024-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Cliente::all();
    }


     /**
     * Registrar la información de un Cliente
     * @OA\Post (
     *     path="/api/clientes",
     *     tags={"Cliente"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombres",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="apellido",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "nombres":"Pedro Felix",
     *                     "apellidos":"Perez"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombres", type="string", example="Aderson Felix"),
     *              @OA\Property(property="apellidos", type="string", example="Perez"),
     *              @OA\Property(property="created_at", type="string", example="2024-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2024-02-23T12:33:45.000000Z")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The apellido field is required."),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores"),
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres'   => 'required',
            'apellidos' => 'required'
        ]);

        $cliente = new Cliente;
        $cliente->nombres   = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->save();

        return $cliente;
    }

    /**
     * Mostrar la información de un cliente
     * @OA\Get (
     *     path="/api/clientes/{id}",
     *     tags={"Cliente"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombres", type="string", example="Aderson Felix"),
     *              @OA\Property(property="apellidos", type="string", example="Perez"),
     *              @OA\Property(property="created_at", type="string", example="2024-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2024-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function show(Cliente $cliente)
    {
        return $cliente;
    }

     /**
     * Actualizar la información de un Cliente
     * @OA\Put (
     *     path="/api/clientes/{id}",
     *     tags={"Cliente"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombres",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="apellidos",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "nombres": "Aderson Felix Editado",
     *                     "apellidos": "Jara Lazaro Editado"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombres", type="string", example="Aderson Felix Editado"),
     *              @OA\Property(property="apellidos", type="string", example="Jara Lazaro Editado"),
     *              @OA\Property(property="created_at", type="string", example="2024-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2024-02-23T12:33:45.000000Z")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The apellidos field is required."),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores"),
     *          )
     *      )
     * )
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombres'   => 'required',
            'apellidos' => 'required'
        ]);

        $cliente->nombres   = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->update();

        return $cliente;
    }

    /**
     * Eliminar la información de un cliente
     * @OA\Delete (
     *     path="/api/clientes/{id}",
     *     tags={"Cliente"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="NO CONTENT"
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No se pudo realizar correctamente la operación"),
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if(is_null($cliente))
        {
            return response()->json('No se pudo realizar correctamente la operación',404);
        }

        $cliente->delete();
        return response()->noContent();
    }
}
