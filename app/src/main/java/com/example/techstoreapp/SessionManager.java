package com.example.techstoreapp;

import android.content.Context;
import android.content.SharedPreferences;

public class SessionManager {

    private static final String PREF_NAME = "TechStoreSession";
    private static final String KEY_IS_LOGGED_IN = "isLoggedIn";

    public static void setLogin(Context context, boolean loggedIn) {
        SharedPreferences prefs = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = prefs.edit();
        editor.putBoolean(KEY_IS_LOGGED_IN, loggedIn);
        editor.apply();
    }

    public static boolean isLoggedIn(Context context) {
        SharedPreferences prefs = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        return prefs.getBoolean(KEY_IS_LOGGED_IN, false);
    }

    public static void logout(Context context) {
        setLogin(context, false);
    }

    public static String getUserName(MainActivity mainActivity) {
        return "";
    }

    public static void setUserName(MainActivity mainActivity, String nameFromLogin) {
    }
}
