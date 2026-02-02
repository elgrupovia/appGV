class ApiService {
  // URL base de la API
  final String _baseUrl = 'http://127.0.0.1:8000/api';
  final AuthService authService = AuthService();

  /// ================================
  /// EVENTOS
  /// ================================

  // Listar todos los eventos
  Future<List<Map<String, dynamic>>> getEvents() async {
    final response = await http.get(
      Uri.parse('$_baseUrl/events'), 
      headers: await _authHeader()
    );

    if (response.statusCode == 200) {
      // Devuelve una lista de eventos
      return List<Map<String, dynamic>>.from(jsonDecode(response.body));
    } else {
      throw Exception('Failed to load events');
    }
  }

  // Obtener un evento específico por ID
  Future<Map<String, dynamic>> getEvent(int id) async {
    final response = await http.get(
      Uri.parse('$_baseUrl/events/$id'), 
      headers: await _authHeader()
    );

    if (response.statusCode == 200) {
      // Devuelve los detalles del evento
      return jsonDecode(response.body);
    } else {
      throw Exception('Failed to load event');
    }
  }

  // Crear un nuevo evento
  Future<Map<String, dynamic>> createEvent(Map<String, dynamic> data) async {
    final response = await http.post(
      Uri.parse('$_baseUrl/events'), 
      headers: await _authHeader(), 
      body: jsonEncode(data)
    );

    if (response.statusCode == 201) {
      // Devuelve el evento creado
      return jsonDecode(response.body);
    }
    throw Exception('Failed to create event');
  }

  // Actualizar un evento existente
  Future<void> updateEvent(int id, Map<String, dynamic> data) async {
    final response = await http.put(
      Uri.parse('$_baseUrl/events/$id'), 
      headers: await _authHeader(), 
      body: jsonEncode(data)
    );

    if (response.statusCode != 200) throw Exception('Failed to update event');
  }

  // Eliminar un evento
  Future<void> deleteEvent(int id) async {
    final response = await http.delete(
      Uri.parse('$_baseUrl/events/$id'), 
      headers: await _authHeader()
    );

    if (response.statusCode != 200) throw Exception('Failed to delete event');
  }

  // Registrar al usuario autenticado en un evento
  Future<void> registerEvent(int eventId) async {
    final response = await http.post(
      Uri.parse('$_baseUrl/events/$eventId/register'), 
      headers: await _authHeader()
    );

    if (response.statusCode != 200) throw Exception('Failed to register');
  }

  /// ================================
  /// REGISTROS DEL USUARIO
  /// ================================

  // Listar todos los registros del usuario actual
  Future<List<Map<String, dynamic>>> myRegistrations() async {
    final response = await http.get(
      Uri.parse('$_baseUrl/my-registrations'), 
      headers: await _authHeader()
    );

    if (response.statusCode == 200) {
      return List<Map<String, dynamic>>.from(jsonDecode(response.body));
    }
    throw Exception('Failed to load registrations');
  }

  // Cancelar un registro específico
  Future<void> cancelRegistration(int registrationId) async {
    final response = await http.delete(
      Uri.parse('$_baseUrl/my-registrations/$registrationId'), 
      headers: await _authHeader()
    );

    if (response.statusCode != 200) throw Exception('Failed to cancel registration');
  }

  /// ================================
  /// USUARIOS
  /// ================================

  // Listar todos los usuarios
  Future<List<Map<String, dynamic>>> getUsers() async {
    final response = await http.get(
      Uri.parse('$_baseUrl/users'), 
      headers: await _authHeader()
    );

    if (response.statusCode == 200) {
      return List<Map<String, dynamic>>.from(jsonDecode(response.body));
    }
    throw Exception('Failed to load users');
  }

  // Crear un nuevo usuario
  Future<Map<String, dynamic>> createUser(Map<String, dynamic> data) async {
    final response = await http.post(
      Uri.parse('$_baseUrl/users'), 
      headers: await _authHeader(), 
      body: jsonEncode(data)
    );

    if (response.statusCode == 201) {
      return jsonDecode(response.body);
    }
    throw Exception('Failed to create user');
  }

  /// ================================
  /// EMPRESAS
  /// ================================

  // Listar todas las empresas
  Future<List<Map<String, dynamic>>> getCompanies() async {
    final response = await http.get(
      Uri.parse('$_baseUrl/companies'), 
      headers: await _authHeader()
    );

    if (response.statusCode == 200) {
      return List<Map<String, dynamic>>.from(jsonDecode(response.body));
    }
    throw Exception('Failed to load companies');
  }

  // Crear una nueva empresa
  Future<Map<String, dynamic>> createCompany(Map<String, dynamic> data) async {
    final response = await http.post(
      Uri.parse('$_baseUrl/companies'), 
      headers: await _authHeader(), 
      body: jsonEncode(data)
    );

    if (response.statusCode == 201) {
      return jsonDecode(response.body);
    }
    throw Exception('Failed to create company');
  }

  /// ================================
  /// HELPER
  /// ================================

  // Encabezados con token de autenticación
  Future<Map<String, String>> _authHeader() async {
    final token = await authService.getToken();
    return {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      if (token != null) 'Authorization': 'Bearer $token',
    };
  }
}
