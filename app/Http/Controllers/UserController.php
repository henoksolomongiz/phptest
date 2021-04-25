<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{


    /** @OA\Info(title="User API", version="0.1") */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Get User Detail
     *
     * @OA\GET(
     *     path="/user/{id}",
     *     tags={"user"},
     *     operationId="GetUser",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="int"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="default",
     *         description= "Get User",
     *          @OA\MediaType(
     *            mediaType="application/html",
     *          )
     *     ),
     * )
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('show', ['user' => $user]);
    }


    /**
     * Update User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\POST(
     *     path="/user",
     *     tags={"user"},
     *     operationId="updateUser",
     *         @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         @OA\Parameter(
     *         name="comment",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *    @OA\Response(
     *         response=400,
     *         description="Invalid Parameters"
     *     ),
     * )
     */
    public function update(Request $request)
    {

        $user = null;

        if ($request->isJson()) {
            $this->ReadParams($request);
            if ($this->json['comment'] == null || $this->json['password'] == null ||  $this->json['id'] == null) {
                   return response()->json("Invalid Parameters", 400);
            }
            if (strtoupper($this->json['password']) != '720DF6C2482218518FA20FDC52D4DED7ECC043AB') {
                return response()->json("Unautorized Access", 401);
            }

            $user = User::find($this->json['id']);
            $user->comments =  $this->json['comment'];
        } else {
            $request->validate([
                'comments' => 'required',
                'password' => 'required',
                'id' => 'required'
            ]);
            if (strtoupper($request->get('password')) != '720DF6C2482218518FA20FDC52D4DED7ECC043AB') {
                return response()->json("Unautorized Access", 401);
            }

            $user = User::find($request->get('id'));
            $user->comments =  $request->get('comment');
        }

        $user->save();

        return response()->json(['status' => 'Updated Successfully'],200);
    }
}
