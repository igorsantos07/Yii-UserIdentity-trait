Yii 1.1's UserIdentity, trait version
=====================================

This is a copy implementation of the original UserIdentity class, but instead as a Trait. This way you can implement
your authentication logic inside your model, if those are tightly coupled - what makes sense in REST models, for
example, where you could have a `user` service that at same time retrieves data and logs in.

Most part of code was originally from `CBaseUserIdentity`, so using this trait is equivalent of inheriting from that
class, except for the fact **you also have to implement IUserIdentity in your class**.

It is also namespaced under `igorsantos07` so your IDE will not conflict with Gii or internal framework files :)
