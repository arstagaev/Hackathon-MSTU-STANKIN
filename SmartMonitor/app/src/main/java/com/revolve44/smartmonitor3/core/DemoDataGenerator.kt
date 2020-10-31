package com.revolve44.smartmonitor3.core

import java.util.*
import kotlin.collections.ArrayList


class DemoDataGenerator {






    fun firstArray() : ArrayList<Float>{
        var rand : Random = Random()
        var demoConsumeWatt1 : ArrayList<Float> = ArrayList()
        demoConsumeWatt1.clear()
        demoConsumeWatt1.add(rand.nextFloat()*1f)
        demoConsumeWatt1.add(rand.nextFloat()*5f)
        demoConsumeWatt1.add(rand.nextFloat()*5f)
        demoConsumeWatt1.add(rand.nextFloat()*10f)

        demoConsumeWatt1.add(rand.nextFloat()*5f)
        demoConsumeWatt1.add(rand.nextFloat()*5f)
        demoConsumeWatt1.add(rand.nextFloat()*5f)
        demoConsumeWatt1.add(rand.nextFloat()*5f)
        ////////////////////////////////////////

        return demoConsumeWatt1
    }
    fun secondArray() : ArrayList<Float>{
        var rand : Random = Random()
        var demoConsumeWatt2 : ArrayList<Float> = ArrayList()
        demoConsumeWatt2.clear()
        demoConsumeWatt2.add(rand.nextFloat()*2f)
        demoConsumeWatt2.add(rand.nextFloat()*6f)
        demoConsumeWatt2.add(rand.nextFloat()*8f)
        demoConsumeWatt2.add(rand.nextFloat()*10f)

        demoConsumeWatt2.add(rand.nextFloat()*4f)
        demoConsumeWatt2.add(rand.nextFloat()*3f)
        demoConsumeWatt2.add(rand.nextFloat()*6f)
        demoConsumeWatt2.add(rand.nextFloat()*7f)
        ////////////////////////////////////////

        return demoConsumeWatt2
    }
    fun thirdArray() : ArrayList<Float>{
        var rand : Random = Random()
        val demoConsumeWatt3 : ArrayList<Float> = ArrayList()
        demoConsumeWatt3.clear()

        demoConsumeWatt3.add(rand.nextFloat()*1f)
        demoConsumeWatt3.add(rand.nextFloat()*2f)
        demoConsumeWatt3.add(rand.nextFloat()*3f)
        demoConsumeWatt3.add(rand.nextFloat()*11f)

        demoConsumeWatt3.add(rand.nextFloat()*8f)
        demoConsumeWatt3.add(rand.nextFloat()*4f)
        demoConsumeWatt3.add(rand.nextFloat()*1f)
        demoConsumeWatt3.add(rand.nextFloat()*2f)

        return demoConsumeWatt3
    }


//    fun getDemo(i : Int): ArrayList<Float>{
//        when (i){
//            1 -> demoConsumeWatt1
//        }
//
//
//        return demoConsumeWatt1
//    }
}