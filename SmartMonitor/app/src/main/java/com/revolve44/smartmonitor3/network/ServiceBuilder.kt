package com.revolve44.smartmonitor3.network


import android.os.Looper
import android.util.Log
import com.revolve44.smartmonitor3.constants.base_url
import okhttp3.OkHttpClient
import okhttp3.logging.HttpLoggingInterceptor
import retrofit2.Retrofit
import retrofit2.adapter.rxjava2.RxJava2CallAdapterFactory
import retrofit2.converter.gson.GsonConverterFactory
import java.lang.Thread.currentThread

object ServiceBuilder {
    val okhttpClientBuilder = OkHttpClient.Builder() //for create a LOGs
    val logging = HttpLoggingInterceptor() //for create a LOGs

//    private val client = OkHttpClient
//        .Builder()
//        //.addInterceptor(logging) //for create a LOGs
//        .build()

    private val retrofit = Retrofit.Builder()
        .client(okhttpClientBuilder.build())
        .baseUrl(base_url)
        .addCallAdapterFactory(RxJava2CallAdapterFactory.create()) // rx
        .addConverterFactory(GsonConverterFactory.create())
        .build()
        .create(TmdbEndpoints::class.java) //rx

    private val retrofit2 = Retrofit.Builder()
        .client(okhttpClientBuilder.build())
        .baseUrl(base_url)
        .addCallAdapterFactory(RxJava2CallAdapterFactory.create()) // rx
        .addConverterFactory(GsonConverterFactory.create())
        .build()
        .create(TmdbEndpoints::class.java) //rx

    fun buildService(): TmdbEndpoints { //rx

        //logging.level = HttpLoggingInterceptor.Level.BODY //for create a LOGs
        logging.level = HttpLoggingInterceptor.Level.BODY
        okhttpClientBuilder.addInterceptor(logging) //for create a LOGs

        Log.d("Threads num ", " SB is "+currentThread().name + "// UI is " + (Thread.currentThread() == Looper.getMainLooper().thread) )
        return retrofit //rx
    }
}