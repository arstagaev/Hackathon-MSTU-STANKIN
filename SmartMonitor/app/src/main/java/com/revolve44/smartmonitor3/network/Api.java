package com.revolve44.smartmonitor3.network;

import android.content.Context;
import android.graphics.Color;
import android.os.Handler;
import android.util.Log;
import android.widget.TextView;


import com.revolve44.smartmonitor3.storage.SharedPref;
import com.revolve44.smartmonitor3.storage.Variables;

import org.jetbrains.annotations.NotNull;

import okhttp3.OkHttpClient;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class Api  {
    private TextView textViewResult;
    private TmdbEndpoints jsonPlaceHolderApi;
    private TmdbEndpoints jsonPlaceHolderApi2;

    private Variables variables = new Variables();
    //private Example exp = new Example();
    Context ctx;

    public void startRequest(){
        OkHttpClient.Builder okhttpClientBuilder = new OkHttpClient.Builder();//for create a LOGs
        HttpLoggingInterceptor logging = new HttpLoggingInterceptor(); //for create a LOGs
        logging.setLevel(HttpLoggingInterceptor.Level.BODY); //for create a LOGs
        okhttpClientBuilder.addInterceptor(logging); //for create a LOGs
        // http://pmelikov.ru:46050/
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://pmelikov.ru:46055/")
                .addConverterFactory(GsonConverterFactory.create())
                .client(okhttpClientBuilder.build()) //for create a LOGs
                .build();

        jsonPlaceHolderApi = retrofit.create(TmdbEndpoints.class);
        ///////////////////////////////////////////////////
        Retrofit retrofit2 = new Retrofit.Builder()
                .baseUrl("http://pmelikov.ru:46050/")
                .addConverterFactory(GsonConverterFactory.create())
                .client(okhttpClientBuilder.build()) //for create a LOGs
                .build();

        jsonPlaceHolderApi2 = retrofit2.create(TmdbEndpoints.class);
        //getPosts();
        //getComments();
        router();
        createPost();

    }

    private void router(){

        //int requests = 3;
        makeGet("http://pmelikov.ru:46055/get_current_total?type=day");
        makeGet("http://pmelikov.ru:46055/get_current_total?type=year");

        for (int i = 0; i <1000;i++){

            final Handler handler = new Handler();
            handler.postDelayed(new Runnable() {
                @Override
                public void run() {
                    makeGet("http://pmelikov.ru:46055/get_current_total?type=hour");
                }
            }, 5000);

        }


    }



    private void createPost() {
        //Post post = new Post(23, "New Title", "New Text");
//        HashMap<String, String> fields = new HashMap<>();
//        fields.put("button_id_that_was_clicked", "2");


        //fields.put("title", "New Title");
        String str = "2";
        Call<Post> call = jsonPlaceHolderApi.createPost(str);
        assert call != null;
        call.enqueue(new Callback<Post>() {
            @Override
            public void onResponse(@NotNull Call<Post> call, @NotNull Response<Post> response) {
                //Log.v("TAG", response.body().toString());
                //String jsonData = response.body().string();

            }
            @Override
            public void onFailure(Call<Post> call, Throwable t) {
                Log.e("ERROR", "RELE "+t.getMessage());
            }
        });
    }


    private void makeGet(String str) {
        //Post post = new Post(23, "New Title", "New Text");
//        HashMap<String, String> fields = new HashMap<>();
//        fields.put("button_id_that_was_clicked", "2");


        //fields.put("title", "New Title");
        //String str = "get_current_total";
        Call<Example> call = jsonPlaceHolderApi2.getIndicatorsData(str);
        assert call != null;
        call.enqueue(new Callback<Example>() {
            @Override
            public void onResponse(@NotNull Call<Example> call, @NotNull Response<Example> response) {
                Example exp = response.body();
                assert exp != null;
                Log.d("response xxx", response.body()+" ][ " + exp.getTotalPrice());

                 SharedPref.setPowerHour(Float.valueOf(exp.getTotal()),ctx);
                 SharedPref.setRubHour(Float.valueOf(exp.getTotalPrice()),ctx);
                //String jsonData = response.body().string();

            }
            @Override
            public void onFailure(@NotNull Call<Example> call, Throwable t) {
                Log.e("ERROR", "GET"+t.getMessage());
            }
        });
    }
}