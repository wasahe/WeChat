// JavaScript Document

  wx.ready(function () {

    wx.onMenuShareAppMessage({
          title: shareData.title,
          desc: shareData.desc,
          link: shareData.link2,
          imgUrl: shareData.imgUrl,
          success: function (res) {
        window.location.href=wx_href;
      }
    });

    wx.onMenuShareTimeline({
      title: shareData.title,
      link: shareData.link1,
      imgUrl: shareData.imgUrl,
      success: function (res) {
        window.location.href=wx_href;
      }
    });

    wx.onMenuShareQQ({
          title: shareData.title,
          desc: shareData.desc,
          link: shareData.link2,
          imgUrl: shareData.imgUrl,
           success: function (res) {
        window.location.href=wx_href;
      }
    });

    wx.onMenuShareWeibo({
          title: shareData.title,
          desc: shareData.desc,
          link: shareData.link2,
          imgUrl: shareData.imgUrl,
          success: function (res) {
        window.location.href=wx_href;
      }
    });


  /*
  wx.onMenuShareAppMessage(shareData);
  wx.onMenuShareTimeline(shareData);*/
  });

  wx.error(function (res) {
      alert(res.errMsg);
  });
