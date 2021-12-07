from django.urls import path

from . import views

urlpatterns = [
    # ex: /polls/
    path('/hello', views.hello, name='hello'),
    path('get-rec-item/', views.getSimItem, name='hehe'),
    path('go', views.go, name='test'),
    path('category', views.findCategory, name='find_category'),
    path('', views.index, name='index'),
    # ex: /polls/5/
    path('<int:question_id>/', views.detail, name='detail'),
    # ex: /polls/5/results/
    path('<int:question_id>/results/', views.results, name='results'),
    # ex: /polls/5/vote/
    path('<int:question_id>/vote/', views.vote, name='vote'),
    path('voice/', views.voice, name='voice'),
    path('get-sim', views.getSimItem, name='getSim'),
    path('runalgorithm/', views.runalgorithm, name='runalgorithm')
]
