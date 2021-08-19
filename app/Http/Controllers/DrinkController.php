<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\UserDrink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DrinkController extends Controller
{
    /**
     * Show all drinks
     *
     * @return array
     */
    public function index(): array
    {
        $user = Auth::user();

        if ($user->getAuthIdentifier() !== NULL) {
            return Drink::all()->toArray();
        }
    }

    /**
     * Create Drink
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $messages = [
            'name.required' => 'Please provide a drink name.',
            'description.required' => 'Please provide a description for the drink.',
            'caffeine_total.required' => 'Please provide the total amount of caffeine in this drink.',
        ];

        $rules = [
            'name' => 'required|max:50',
            'description' => 'required|max:512',
            'caffeine_total' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $drink = new Drink([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'caffeine_total' => $request->input('caffeine_total')
        ]);
        $drink->save();

        return response()->json('Drink created!');
    }

    /**
     * Show Drinks
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $drink = Drink::find($id);
        return response()->json($drink);
    }

    /**
     * Update Drink by ID
     *
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $drink = Drink::find($id);
        $drink->update($request->all());

        return response()->json('Drink updated!');
    }

    /**
     * Delete Drink by ID
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $drink = Drink::find($id);
        $drink->delete();

        return response()->json('Drink deleted!');
    }

    /**
     * Add a User's Consumed Drink
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addMyDrink(Request $request): JsonResponse
    {
        $messages = [
            'drink_id.required' => 'Please select a drink name.',
            'selected_date.required' => 'Please provide a date on which you consumed this drink.'
        ];

        $rules = [
            'drink_id' => 'required',
            'selected_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $userDrink = new UserDrink([
            'user_id' => Auth::user()->id,
            'drink_id' => $request->input('drink_id'),
            'consumed_at' => $request->input('selected_date')
        ]);
        $userDrink->save();

        return response()->json('User Drink created!');
    }

    /**
     * Get a User's All-Time Consumed Drink List
     *
     * @return JsonResponse
     */
    public function getMyDrinks(): JsonResponse
    {
        $user_id = Auth::user()->id;

        // TODO: Convert to Query Builder
        $my_drinks = DB::select("SELECT COUNT(ud.drink_id) AS total_consumed, SUM(d.caffeine_total) AS total_caffeine, d.name, ud.consumed_at FROM laravel.user_drinks ud INNER JOIN laravel.drinks d ON ud.drink_id = d.id INNER JOIN laravel.users u ON ud.user_id = u.id WHERE ud.user_id = ? GROUP BY u.name, d.name, ud.consumed_at ORDER BY ud.consumed_at DESC", [$user_id]);

        return response()->json($my_drinks);
    }

    /**
     * Get a User's Consumed Drink List for the Current Day
     *
     * @return JsonResponse
     */
    public function getMyConsumedDrinks(): JsonResponse
    {
        $user_id = Auth::user()->id;

        // TODO: Convert to Query Builder
        $my_drinks = DB::select("SELECT d.name, COUNT(ud.drink_id) AS total_consumed, SUM(d.caffeine_total) AS total_caffeine, CASE WHEN SUM(d.caffeine_total) >= 500 THEN 0 WHEN SUM(d.caffeine_total) < 500 THEN ROUND(500 / SUM(d.caffeine_total), 1) END AS total_available FROM laravel.drinks d LEFT JOIN laravel.user_drinks ud ON d.id = ud.drink_id LEFT JOIN laravel.users u ON ud.user_id = u.id WHERE u.id = ? AND ud.consumed_at = CURDATE() GROUP BY d.name UNION SELECT d.name, 0, 0, ROUND(500 / SUM(d.caffeine_total), 1) AS total_available FROM laravel.drinks d WHERE d.name NOT IN (SELECT d.name FROM laravel.drinks d LEFT JOIN laravel.user_drinks ud ON d.id = ud.drink_id LEFT JOIN laravel.users u ON ud.user_id = u.id WHERE u.id = ? AND ud.consumed_at = CURDATE() GROUP BY d.name) GROUP BY d.name", [$user_id, $user_id]);

        return response()->json($my_drinks);
    }

}
