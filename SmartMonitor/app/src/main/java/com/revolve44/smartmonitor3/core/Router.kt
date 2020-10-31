package com.revolve44.smartmonitor3.core

import java.util.ArrayList

class Router {

    fun arrayHolder(): ArrayList<String> {
        var arrayofDevice : ArrayList<String> = ArrayList()

        arrayofDevice.add("Xiamomi Щетка")
        arrayofDevice.add("Умная розетка №4")
        arrayofDevice.add("MP3 Центр")
        arrayofDevice.add("Tesla PowerWall")

        arrayofDevice.add("Телевизор")
        arrayofDevice.add("Обогреватель Huawei")
        arrayofDevice.add("Вентилятор Xiaomi")
        arrayofDevice.add("Холодильник")


        return arrayofDevice
    }
    fun arrayPowerConsume(): ArrayList<Float> {
        var arrayPowerConsume : ArrayList<Float> = ArrayList()
        arrayPowerConsume.add(0.05f)
        arrayPowerConsume.add(3.2f)
        arrayPowerConsume.add(4.2f)
        arrayPowerConsume.add(1f)

        arrayPowerConsume.add(0.6f)
        arrayPowerConsume.add(0.1f)
        arrayPowerConsume.add(1.2f)
        arrayPowerConsume.add(0.28f)
        return arrayPowerConsume
    }

}