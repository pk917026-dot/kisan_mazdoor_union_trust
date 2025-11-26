public function role() {
    return $this->belongsTo(Role::class);
}

public function hasPermission($permission) {
    return $this->role->permissions->pluck('name')->contains($permission);
}
