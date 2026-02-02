import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class AuthService {
  final String _baseUrl = 'http://10.0.2.2:8000/api'; // Use 10.0.2.2 for Android emulator

  Future<Map<String, dynamic>> login(String email, String password) async {
    final response = await http.post(
      Uri.parse('$_baseUrl/login'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Accept': 'application/json',
      },
      body: jsonEncode(<String, String>{
        'email': email,
        'password': password,
      }),
    );

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      if (data.containsKey('token')) {
        final prefs = await SharedPreferences.getInstance();
        await prefs.setString('auth_token', data['token']);
      }
      return data;
    } else {
      throw Exception('Failed to login');
    }
  }

  Future<Map<String, dynamic>> register(String name, String email, String password, String passwordConfirmation) async {
    final response = await http.post(
      Uri.parse('$_baseUrl/register'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Accept': 'application/json',
      },
      body: jsonEncode(<String, String>{
        'name': name,
        'email': email,
        'password': password,
        'password_confirmation': passwordConfirmation,
      }),
    );

    if (response.statusCode == 201) {
      final data = jsonDecode(response.body);
      if (data.containsKey('token')) {
        final prefs = await SharedPreferences.getInstance();
        await prefs.setString('auth_token', data['token']);
      }
      return data;
    } else {
      throw Exception('Failed to register');
    }
  }

  Future<void> logout() async {
    final token = await getToken();
    await http.post(
      Uri.parse('$_baseUrl/logout'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer $token',
      },
    );
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove('auth_token');
  }

  Future<Map<String, dynamic>> getUser() async {
    final token = await getToken();
    final response = await http.get(
      Uri.parse('$_baseUrl/user'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      return jsonDecode(response.body);
    } else {
      throw Exception('Failed to get user');
    }
  }

  Future<String?> getToken() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('auth_token');
  }
}
