import 'package:flutter/material.dart';
import 'package:frontend/models/user.dart';
import 'package:frontend/services/auth_service.dart';

class AuthProvider with ChangeNotifier {
  final AuthService _authService = AuthService();
  String? _token;
  User? _user;
  bool _isAuthenticated = false;

  bool get isAuthenticated => _isAuthenticated;
  String? get token => _token;
  User? get user => _user;

  Future<void> _fetchUser() async {
    try {
      final userData = await _authService.getUser();
      _user = User.fromJson(userData);
      notifyListeners();
    } catch (e) {
      // Handle error
    }
  }

  Future<void> login(String email, String password) async {
    try {
      await _authService.login(email, password);
      _token = await _authService.getToken();
      if (_token != null) {
        _isAuthenticated = true;
        await _fetchUser();
        notifyListeners();
      }
    } catch (e) {
      _isAuthenticated = false;
      rethrow;
    }
  }

  Future<void> register(String name, String email, String password, String passwordConfirmation) async {
    try {
      await _authService.register(name, email, password, passwordConfirmation);
      _token = await _authService.getToken();
      if (_token != null) {
        _isAuthenticated = true;
        await _fetchUser();
        notifyListeners();
      }
    } catch (e) {
      _isAuthenticated = false;
      rethrow;
    }
  }

  Future<void> logout() async {
    await _authService.logout();
    _isAuthenticated = false;
    _token = null;
    _user = null;
    notifyListeners();
  }

  Future<void> tryAutoLogin() async {
    _token = await _authService.getToken();
    if (_token != null) {
      _isAuthenticated = true;
      await _fetchUser();
    } else {
      _isAuthenticated = false;
    }
    notifyListeners();
  }
}

