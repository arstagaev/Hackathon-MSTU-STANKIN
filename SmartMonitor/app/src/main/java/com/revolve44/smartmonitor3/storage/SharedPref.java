package com.revolve44.smartmonitor3.storage;

import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;

public class SharedPref {

    private static SharedPreferences preferences;

    private SharedPref(Context context) {
        preferences = PreferenceManager.getDefaultSharedPreferences(context);
    }

    public static void initPreferences(Context context) {
        new SharedPref(context);
    }

    public static Float getTemp(Context context) {
        return preferences.
                getFloat("temp", 10);
    }

    public static void setRubHour(Float rub, Context context) {
        SharedPreferences.Editor editor = preferences.edit();
        editor.putFloat("rubHour", rub).apply();
        editor.apply();
    }
    public static Float getRubHour(Context context) {
        return preferences.
                getFloat("rubHour", 10);
    }

    public static void setPowerHour(Float rub, Context context) {
        SharedPreferences.Editor editor = preferences.edit();
        editor.putFloat("PowerHour", rub).apply();
        editor.apply();
    }
    public static Float getPowerHour(Context context) {
        return preferences.
                getFloat("PowerHour", 10);
    }

    //////////////// Chosen Station/////////////////////////////////////////////////////////////////////
    public static void setMainStation(String Name, int NominalPower, Float latitude, Float longitude, Context context) {
        SharedPreferences.Editor editor = preferences.edit();
        editor.putString("name", Name);
        editor.putInt("nominalpower", NominalPower);
        editor.putFloat("lat", latitude);
        editor.putFloat("lon", longitude);
        editor.apply();
    }

    public static void setRubDay(Float rub, Context context) {
        SharedPreferences.Editor editor = preferences.edit();
        editor.putFloat("rubDay", rub).apply();
        editor.apply();
    }
    public static Float getRubDay(Context context) {
        return preferences.
                getFloat("rubDay", 10);
    }

    public static void setPowerDay(Float rub, Context context) {
        SharedPreferences.Editor editor = preferences.edit();
        editor.putFloat("PowerDay", rub).apply();
        editor.apply();
    }
    public static Float getPowerDay(Context context) {
        return preferences.
                getFloat("PowerDay", 10);
    }

    //////////////////////////////////////////////////////////////

    public static void setRubYear(Float rub, Context context) {
        SharedPreferences.Editor editor = preferences.edit();
        editor.putFloat("rubYear", rub).apply();
        editor.apply();
    }
    public static Float getRubYear(Context context) {
        return preferences.
                getFloat("rubYear", 10);
    }

    public static void setPowerYear(Float rub, Context context) {
        SharedPreferences.Editor editor = preferences.edit();
        editor.putFloat("PowerYear", rub).apply();
        editor.apply();
    }
    public static Float getPowerYear(Context context) {
        return preferences.
                getFloat("PowerYear", 10);
    }

}