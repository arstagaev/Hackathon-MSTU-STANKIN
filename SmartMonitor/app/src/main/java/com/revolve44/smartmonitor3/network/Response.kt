package com.revolve44.smartmonitor3.network


import com.google.gson.annotations.SerializedName

class SuperResponse {
    @SerializedName("coord")
    var coord: Coord? = null
    @SerializedName("sys")
    var sys: Sys? = null
    //    @SerializedName("weather")
//    public ArrayList<Weather> weather = new ArrayList<Weather>();
    @SerializedName("main")
    var main: Main? = null
    @SerializedName("wind")
    var wind: Wind? = null
    @SerializedName("rain")
    var rain: Rain? = null
    @SerializedName("clouds")
    var clouds: Clouds? = null
    @SerializedName("dt")
    var dt = 0f
    @SerializedName("id")
    var id = 0
    @SerializedName("name")
    var name: String? = null
    @SerializedName("cod")
    var cod = 0f
    @SerializedName("temp")
    var temp = 0f
    // test \/
//    @SerializedName("Weather")
//    var weather: weather? = null
    @SerializedName("timezone")
    var timezone: Long = 0
}

class weather {
    @SerializedName("id")
    var id = 0
    @SerializedName("main")
    var main: String? = null
    @SerializedName("description")
    var description: String? = null
    @SerializedName("icon")
    var icon: String? = null
}

class Clouds {
    @SerializedName("all")
    var all = 0f
}

class Rain {
    @SerializedName("3h")
    var h3 = 0f
}

class Wind {
    @SerializedName("speed")
    var speed = 0f
    @SerializedName("deg")
    var deg = 0f
}

class Main {
    @SerializedName("temp")
    var temp = 0f
    @SerializedName("humidity")
    var humidity = 0f
    @SerializedName("pressure")
    var pressure = 0f
    @SerializedName("temp_min")
    var temp_min = 0f
    @SerializedName("temp_max")
    var temp_max = 0f
}

class Sys {
    @SerializedName("country")
    var country: String? = null
    @SerializedName("sunrise")
    var sunrise: Long = 0
    @SerializedName("sunset")
    var sunset: Long = 0
}

class Coord {
    @SerializedName("lon")
    var lon = 0f
    @SerializedName("lat")
    var lat = 0f
}

class Timezone {
    @SerializedName("timezone")
    var timezone = 0f
}

class Sunrise {
    @SerializedName("sunrise")
    var sunrise = 0f
}

class Sunset {
    @SerializedName("sunset")
    var sunset = 0f
}