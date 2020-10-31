package com.revolve44.smartmonitor3.network

import android.os.Looper
import android.util.Log
import android.widget.Toast
import com.google.gson.Gson
import com.revolve44.smartmonitor3.constants.api_key
import io.reactivex.android.schedulers.AndroidSchedulers
import io.reactivex.disposables.CompositeDisposable
import io.reactivex.schedulers.Schedulers

class LaunchPadRetrofit {

     fun apilaunch(){
        val compositeDisposable = CompositeDisposable() //?
        compositeDisposable.add(
            ServiceBuilder.buildService().getWeather("55.751244","37.618423", api_key)

                .subscribeOn(Schedulers.io())
                .observeOn(AndroidSchedulers.mainThread())
                .subscribe({
                        response -> onResponse(response)

                }, {
                        t -> onFailure(t)
                    Log.e("ERROR", " ~ "+t)
                }))

    }

    private fun onResponse(response: SuperResponse) {
        Log.d("respone is ", " "+ Gson().toJson(response))
        Log.d("TAG", "onResponse: ConfigurationListener::"+response.id)
        Log.d("Threads num ", " respons is "+Thread.currentThread() + " UI is " + (Thread.currentThread() == Looper.getMainLooper().thread) )
    }

    private fun onFailure(t: Throwable) {
        //  HTTP 401 Unauthorized // retrofit2.adapter.rxjava2.HttpException: HTTP 401
        //Toast.makeText(this,t.message, Toast.LENGTH_SHORT).show()
        Log.d("ERROR ", " "+t.message+" // " +t)

    }

}