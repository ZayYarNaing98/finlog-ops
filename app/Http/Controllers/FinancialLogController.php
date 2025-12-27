<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FinancialLog;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinancialLogController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:income,expense',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'discord_user_id' => 'nullable|string',
            'discord_username' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get or create a default user for Discord entries
        $user = User::firstOrCreate(
            ['email' => 'discord@finlog.com'],
            [
                'name' => 'Discord Bot',
                'password' => bcrypt('discord-bot-user'),
                'email_verified_at' => now(),
            ]
        );

        $financialLog = FinancialLog::create([
            'user_id' => $user->id,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'type' => $request->type,
            'transaction_date' => $request->transaction_date,
            'description' => $request->description ?? ($request->discord_username ? "Discord: {$request->discord_username}" : null),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Financial log created successfully',
            'data' => $financialLog->load('category'),
        ], 201);
    }
}
