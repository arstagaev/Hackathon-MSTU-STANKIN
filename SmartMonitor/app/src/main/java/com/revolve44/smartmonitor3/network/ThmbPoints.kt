package com.revolve44.smartmonitor3.network


import io.reactivex.Observable
import retrofit2.Call
import retrofit2.http.*


//https://samples.openweathermap.org/data/2.5/weather?lat=35&lon=139&appid=b6907d289e10d714a6e88b30761fae22

interface TmdbEndpoints {

    @GET("data/2.5/weather?")
    fun getWeather(
        @Query("lat") latitude: String,
        @Query("lon") longitude: String,
        @Query("APPID") app_id: String
    ): Observable<SuperResponse>

    @GET("data/2.5/weather?")
    fun getHub(@Query("lat") num: Int): Observable<ResponseHub>

//    @GET(".")
//    fun getPosts(
//        @Query("get_current_total")
//    ): Call<Example>?

    @GET
    fun getIndicatorsData(@Url url: String?): Call<Example?>?

    @Multipart
    @POST("php/buttons.php")
    fun createPost(@Part("button_id_that_was_clicked") post: String?): Call<Post?>?



//    @GET("/3/movie/popular")
//    fun getMovies(@Query("api_key") key: String): Call<PopularMovies>
    //https://api.openweathermap.org/data/2.5/weather?lat

}