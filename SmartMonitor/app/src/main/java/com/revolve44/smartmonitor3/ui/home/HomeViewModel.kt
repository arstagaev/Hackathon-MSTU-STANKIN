package com.revolve44.smartmonitor3.ui.home

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel

class HomeViewModel : ViewModel() {

    private val _text = MutableLiveData<String>().apply {
        value = "This is home Fragment"
    }
    private val _text2 = MutableLiveData<String>().apply {
        return@apply
    }
    val text: LiveData<String> = _text
    val text2: LiveData<String> = _text2
}