<?php
function Blitz2BB($code, 
	$in_before, $in_after,
	$in_kw_o, $in_kw_c,
	$in_comm_o, $in_comm_c, 
	$in_str_o, $in_str_c, 
	$in_digit_o, $in_digit_c)
{
	// keywords array (Blitz3D 1.97)
	$vars = array(
'Abs','After','And','Before','Case','Const','Data','Default','Delete','Dim','Each','Else','ElseIf','EndIf','Exit','False','Field'
,'First','Float','For','Forever','Function','Global','Gosub','Goto','Handle','If','Include','Insert','Int','Last','Local','Mod',
'New','Next','Not','Null','Object','Or','Pi','Read','Repeat','Restore','Return','Sar','Select','Sgn','Shl','Shr','Step','Str',
'Then','To','True','Type','Until','Wend','While','Xor','DebugLog','FreeTimer','WaitTimer','CreateTimer','SetEnv','GetEnv',
'SystemProperty','CommandLine','MilliSecs','Delay','ExecFile','RuntimeError','AppTitle','Stop','End','RuntimeStats','EntityClass'
,'EntityName','NameEntity','FreeEntity','ShowEntity','HideEntity','EntityOrder','EntityAutoFade','EntityFX','EntityBlend',
'EntityTexture','EntityShininess','EntityAlpha','EntityColor','PaintEntity','FindChild','GetChild','CountChildren','EntityParent'
,'Animating','AnimLength','AnimTime','AnimSeq','ExtractAnimSeq','AddAnimSeq','SetAnimKey','Animate','SetAnimTime','AlignToVector'
,'PointEntity','RotateEntity','ScaleEntity','PositionEntity','TranslateEntity','TurnEntity','MoveEntity','CollisionTriangle',
'CollisionSurface','CollisionEntity','CollisionTime','CollisionNZ','CollisionNY','CollisionNX','CollisionZ','CollisionY',
'CollisionX','CountCollisions','EntityCollided','EntityDistance','EntityBox','EntityRadius','GetEntityType','GetParent',
'EntityPickMode','EntityType','ResetEntity','DeltaYaw','DeltaPitch','VectorPitch','VectorYaw','TFormedZ','TFormedY','TFormedX',
'TFormNormal','TFormVector','TFormPoint','GetMatElement','EntityRoll','EntityYaw','EntityPitch','EntityZ','EntityY','EntityX',
'CopyEntity','EmitSound','CreateListener','ModifyTerrain','TerrainHeight','TerrainSize','TerrainZ','TerrainY','TerrainX',
'TerrainShading','TerrainDetail','LoadTerrain','CreateTerrain','CreatePlane','CreateMirror','BSPAmbientLight','BSPLighting',
'LoadBSP','MD2Animating','MD2AnimLength','MD2AnimTime','AnimateMD2','LoadMD2','SpriteViewMode','HandleSprite','ScaleSprite',
'RotateSprite','LoadSprite','CreateSprite','CreatePivot','LightConeAngles','LightRange','LightColor','CreateLight',
'PickedTriangle','PickedSurface','PickedEntity','PickedTime','PickedNZ','PickedNY','PickedNX','PickedZ','PickedY','PickedX',
'CameraPick','LinePick','EntityPick','EntityVisible','EntityInView','ProjectedZ','ProjectedY','ProjectedX','CameraProject',
'CameraFogMode','CameraFogRange','CameraFogColor','CameraViewport','CameraProjMode','CameraClsMode','CameraClsColor',
'CameraRange','CameraZoom','CreateCamera','TriangleVertex','VertexW','VertexV','VertexU','VertexAlpha','VertexBlue','VertexGreen'
,'VertexRed','VertexNZ','VertexNY','VertexNX','VertexZ','VertexY','VertexX','CountTriangles','CountVertices','VertexTexCoords',
'VertexColor','VertexNormal','VertexCoords','AddTriangle','AddVertex','PaintSurface','ClearSurface','FindSurface',
'GetEntityBrush','GetSurfaceBrush','CreateSurface','MeshCullBox','GetSurface','CountSurfaces','MeshesIntersect','MeshDepth',
'MeshHeight','MeshWidth','LightMesh','UpdateNormals','AddMesh','PaintMesh','FlipMesh','FitMesh','PositionMesh','RotateMesh',
'ScaleMesh','CopyMesh','CreateCone','CreateCylinder','CreateSphere','CreateCube','CreateMesh','LoadAnimSeq','LoadAnimMesh',
'LoadMesh','BrushFX','BrushBlend','GetBrushTexture','BrushTexture','BrushShininess','BrushAlpha','BrushColor','FreeBrush',
'LoadBrush','CreateBrush','TextureFilter','ClearTextureFilters','TextureBuffer','SetCubeMode','SetCubeFace','TextureName',
'TextureHeight','TextureWidth','PositionTexture','RotateTexture','ScaleTexture','TextureCoords','TextureBlend','FreeTexture',
'LoadAnimTexture','LoadTexture','CreateTexture','Stats3D','TrisRendered','ActiveTextures','ClearWorld','RenderWorld',
'CaptureWorld','UpdateWorld','Collisions','ClearCollisions','AmbientLight','WireFrame','AntiAlias','Dither','WBuffer',
'GfxDriverCaps3D','HWTexUnits','HWMultiTex','LoaderMatrix','NetMsgData','NetMsgTo','NetMsgFrom','NetMsgType','RecvNetMsg',
'SendNetMsg','NetPlayerLocal','NetPlayerName','DeleteNetPlayer','CreateNetPlayer','StopNetGame','JoinNetGame','HostNetGame',
'StartNetGame','Load3DSound','ChannelPlaying','ChannelPan','ChannelVolume','ChannelPitch','ResumeChannel','PauseChannel',
'StopChannel','PlayCDTrack','PlayMusic','PlaySound','SoundPan','SoundVolume','SoundPitch','LoopSound','FreeSound','LoadSound',
'DirectInputEnabled','EnableDirectInput','FlushJoy','JoyVDir','JoyUDir','JoyZDir','JoyYDir','JoyXDir','JoyHat','JoyRoll','JoyYaw'
,'JoyPitch','JoyV','JoyU','JoyZ','JoyY','JoyX','JoyWait','WaitJoy','GetJoy','JoyHit','JoyDown','JoyType','MoveMouse','FlushMouse'
,'MouseZSpeed','MouseYSpeed','MouseXSpeed','MouseZ','MouseY','MouseX','MouseWait','WaitMouse','GetMouse','MouseHit','MouseDown',
'FlushKeys','WaitKey','GetKey','KeyHit','KeyDown','HidePointer','ShowPointer','Locate','Input','Print','Write','ImageRectCollide'
,'ImageRectOverlap','RectsOverlap','ImagesCollide','ImagesOverlap','TFormFilter','TFormImage','RotateImage','ResizeImage',
'ScaleImage','ImageYHandle','ImageXHandle','ImageHeight','ImageWidth','AutoMidHandle','MidHandle','HandleImage','MaskImage',
'DrawBlockRect','DrawImageRect','TileBlock','TileImage','DrawBlock','DrawImage','ImageBuffer','GrabImage','SaveImage','FreeImage'
,'LoadAnimImage','CreateImage','CopyImage','LoadImage','CloseMovie','MoviePlaying','MovieHeight','MovieWidth','DrawMovie',
'OpenMovie','StringHeight','StringWidth','FontHeight','FontWidth','FreeFont','LoadFont','CopyRect','Text','Line','Oval','Rect',
'Plot','Cls','SetFont','ClsColor','ColorBlue','ColorGreen','ColorRed','GetColor','Color','Viewport','Origin','CopyPixelFast',
'CopyPixel','WritePixelFast','ReadPixelFast','WritePixel','ReadPixel','UnlockBuffer','LockBuffer','SaveBuffer','LoadBuffer',
'GraphicsBuffer','SetBuffer','GraphicsDepth','GraphicsHeight','GraphicsWidth','Flip','VWait','ScanLine','BackBuffer',
'FrontBuffer','GammaBlue','GammaGreen','GammaRed','UpdateGamma','SetGamma','EndGraphics','Graphics3D','Graphics','Windowed3D',
'GfxMode3D','GfxMode3DExists','CountGfxModes3D','GfxDriver3D','TotalVidMem','AvailVidMem','GfxModeDepth','GfxModeHeight',
'GfxModeWidth','GfxModeExists','CountGfxModes','SetGfxDriver','GfxDriverName','CountGfxDrivers','CallDLL','WriteBytes',
'ReadBytes','PokeFloat','PokeInt','PokeShort','PokeByte','PeekFloat','PeekInt','PeekShort','PeekByte','CopyBank','ResizeBank',
'BankSize','FreeBank','CreateBank','DeleteFile','CopyFile','FileType','FileSize','DeleteDir','CreateDir','ChangeDir','CurrentDir'
,'NextFile','CloseDir','ReadDir','SeekFile','FilePos','CloseFile','WriteFile','ReadFile','OpenFile','TCPTimeouts','TCPStreamPort'
,'TCPStreamIP','AcceptTCPStream','CloseTCPServer','CreateTCPServer','CloseTCPStream','OpenTCPStream','UDPTimeouts','UDPMsgPort',
'UDPMsgIP','UDPStreamPort','UDPStreamIP','RecvUDPMsg','SendUDPMsg','CloseUDPStream','CreateUDPStream','HostIP','CountHostIPs',
'DottedIP','CopyStream','WriteLine','WriteString','WriteFloat','WriteInt','WriteShort','WriteByte','ReadLine','ReadString',
'ReadFloat','ReadInt','ReadShort','ReadByte','ReadAvail','Eof','CurrentTime','CurrentDate','Bin','Hex','Len','Asc','Chr','RSet',
'LSet','Trim','Lower','Upper','Mid','Instr','Replace','Right','Left','String','RndSeed','SeedRnd','Rand','Rnd','Log10','Log',
'Exp','Ceil','Floor','Sqr','ATan2','ATan','ACos','ASin','Tan','Cos','Sin');

	// [code] tags
	$new_code = "$in_before\n$code\n$in_after";
	// strings
	$new_code = ereg_replace("()(\"[^\"]*\")()", "\\1$in_str_o\\2$in_str_c\\3", $new_code);
	
	// keywords
	foreach ($vars as $v)
	{
		$new_code = eregi_replace("([^[:alnum:]])($v)([^[:alnum:]])", "\\1$in_kw_o{$v}$in_kw_c\\3", $new_code);
	}
	
	// comments
	$new_code = ereg_replace("()(;[^\r\n]*)[\r\n]()", "\\1$in_comm_o\\2$in_comm_c\\3", $new_code);
	// digits
	$new_code = ereg_replace("([^A-Za-z])([-]?[[:digit:]]*[.]?[[:digit:]]+)()", "\\1$in_digit_o\\2$in_digit_c\\3", $new_code);

	return $new_code;
}
?>